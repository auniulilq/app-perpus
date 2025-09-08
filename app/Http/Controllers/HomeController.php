<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\DetailBorrows;


class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
        $totalBooks = Book::count();
        $totalStock = Book::sum('stock');

        //detail_buku ada tidak buku yang sedang di pinjam,actual_date = null


        $borrowedBooks = DetailBorrows::with('book','borrow')->whereHas('borrow',function($q){
        $q->whereNull('actual_return_date');
        })->count();

        $returnBooks = Borrows::where('status',0)->Arr::whereNotNull('actual_return_date')->count();
        $NotReturnBooks = Borrows::where('status',1)->whereNull('actual_return_date')->count();

        $fines = Borrows::with('member')->where('fine','>',0)->get();
        $totalFines = Borrows::sum('fine');

        return view('admin.dashboard',compact('totalBooks','totalStock','borrowedBooks','returnBooks','notReturnBook','fines','totalFines'));
    }
}
