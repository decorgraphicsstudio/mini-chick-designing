<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;

class DataController extends Controller
{
    public function lastdata(Request $request)
    {
        // Fetch the latest record (object) based on 'id'
        $latestDesignings = DB::table('designing')->leftJoin('printer', 'designing.id', '=', 'printer.designId')->select('designing.*', 'printer.printer_name')->orderBy('designing.id', 'desc')->take(3)->get();

        // Pass the full object to the view
        return view('dataad', compact('latestDesignings'));
    }

    public function adddata(Request $request)
    {
        $desname = $request->input('des_name');
        $papers = $request->input('papers');
        $rate = $request->input('rate');
        $amount = $request->input('amount');

        // Handle the image upload
        if ($request->hasFile('des_img')) {
            $image = $request->file('des_img');
            $imagePath = $image->store('designs', 'public'); // store the image in the 'public/storage/designs' directory
            $desimg = $imagePath;
        } else {
            return back()->withErrors(['image' => 'Image upload failed.']);
        }

        // Insert data into the database
        $query = DB::insert('INSERT INTO `designing`(`des_name`, `des_img`, `papers`, `rate`, `amount`) VALUES (?,?,?,?,?)', [$desname, $desimg, $papers, $rate, $amount]);

        if ($query) {
            return redirect()->route('dataadd')->with('success', 'Data inserted successfully.');
        } else {
            return back()->withErrors(['database' => 'Data insertion failed.']);
        }
    }
    public function showdata()
    {
        $totalAmount = DB::table('designing')->sum('amount');
        $totalPapers = DB::table('designing')->sum('papers');
        $data = DB::select("SELECT designing.*, printer.printer_name FROM designing LEFT JOIN printer ON designing.id = printer.designId ORDER BY designing.id DESC;");
        $totalPay = Payment::sum('payment_amount');
        $totalPayments = Payment::sum('payment_amount');
        $balance = $totalAmount - $totalPayments;
        return view('showdata', compact('totalAmount', 'totalPapers', 'data', 'totalPay', 'balance'));
    }
    public function printer(Request $request)
    {
        // Pass the full object to the view
        return view('addprinter');
    }
    public function addprinter(Request $request)
    {
        $printer_name = $request->input('printer_name');
        $design_id = $request->input('design_id');

        // Check if the design_id exists in the designing table
        $designExists = DB::table('printer')->where('id', $design_id)->exists();

        if ($designExists) {
            // Design does not exist, return error
            return back()->withErrors(['design_id' => 'printer name is already exist.']);
        }

        // Insert into the printer table
        $query = DB::table('printer')->insert([
            'printer_name' => $printer_name,
            'designId' => $design_id
        ]);

        if ($query) {
            return redirect()->route('printer')->with('success', 'Data inserted successfully.');
        } else {
            return back()->withErrors(['database' => 'Data insertion failed.']);
        }
    }

    public function designName(Request $request)
    {
        $design = DB::table('designing')->where('id', $request->design_id)->first(); // Query to find the design by ID

        if ($design) {
            return response()->json([
                'design' => $design,
                'image' => asset('storage/' . $design->des_img) // Adjust according to your storage method
            ]);
        }

        return response()->json(['design_name' => 'Design not found']);
    }
}
