<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrows;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DetailBorrows;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $borrows = Borrows::with('member','detailBorrows')->orderBy('id','desc')->get();
        return view('admin.pinjam.index',compact('borrows'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //PJM-today-001
        $kode = "PJM";
        $today = Carbon::now()->format('Ymd');
        $prefix = $kode . "-" . $today;
        $lastTransaction = Borrows::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->trans_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $newNumber = "001";
        }
        $trans_number = $prefix . $newNumber;

        $members = Member::get();
        $categories = Category::get();
        return view('admin.pinjam.create', compact('members', 'categories', 'trans_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        try {
            $insertBorrow = Borrows::create([
                'id_anggota'=> $request->id_anggota,
                'trans_number'=> $request->trans_number,
                'return_date'=> $request->return_date,
                'note'=> $request->note,
            ]);
    
            foreach ($request->id_buku as $key => $value){
                DetailBorrows::create([
                    'id_borrow' => $insertBorrow->id,
                    'id_book' => $request->id_buku[$key],
                ]);
            }
            //code...
            DB::commit();
            return redirect()->to('print-peminjam',$insertBorrow->id);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }


    }
   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $borrows = Borrows::with('DetailBorrows.book','member')->find($id);
        return view('admin.pinjam.show',compact('borrows'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
    public function getBukuByIdCategory($id_category)
    {
        try {
            $books = Book::where('id_kategori', $id_category)->get();
            return response()->json(['status' => 'success', 'massage' => 'fetch book succes', 'data' => $books]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'massage' => $th->getMessage()], 500);
        }
    }

    public function print($id_borrow)
    {
        $borrow = Borrows::with('member','detailBorrows.book')->find($id_borrow);
        return view('admin.pinjam.print',compact('borrow'));
    }
}
