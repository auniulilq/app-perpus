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
        $totalBooks = Book::count();
        $totalStock = Book::sum('stock');

        $borrowedBooks = DetailBorrows::with('book', 'borrow')
            ->whereHas('borrow', function ($q) {
                $q->whereNull('actual_return_date');
            })->count();

        $returnBooks = Borrows::where('status', 0)
            ->whereNotNull('actual_return_date')->count();

        $notReturnBooks = Borrows::where('status', 1)
            ->whereNull('actual_return_date')->count();

        $fines = Borrows::with('member')
            ->where('fine', '>', 0)
            ->get();

        $totalFines = Borrows::sum('fine');

        // cukup return sekali aja, di bawah
        return view('admin.dashboard', compact(
            'totalBooks',
            'totalStock',
            'borrowedBooks',
            'returnBooks',
            'notReturnBooks',
            'fines',
            'totalFines'
        ));
    }
}
