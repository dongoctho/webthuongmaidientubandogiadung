<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherFormRequest;
use App\Http\Requests\EditVoucherFormRequest;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucherRepository;
    protected $productRepository;

    public function __construct(
        VoucherRepositoryInterface $voucherRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface
    ) {
        $this->voucherRepository = $voucherRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
    }

    // show voucher page
    public function index()
    {
        $check_voucher = true;
        $products = $this->productRepository->getAll();

        return view('admin.voucher.add_voucher', compact('products', 'check_voucher'));
    }

    // create voucher to  database
    public function create(CreateVoucherFormRequest $request)
    {
        $this->voucherRepository->create($request->toArray());

        return redirect()->route('list_voucher')->with('msg', 'Created');
    }

    // show list voucher
    public function list(Request $request)
    {
        $check_voucher = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;

        $vouchers = $this->voucherRepository->getVoucherByCondition($data);

        return view('admin.voucher.list_voucher', compact('vouchers', 'key', 'data', 'check_voucher'));
    }

    // delete voucher
    public function destroy(int $id)
    {
        $this->voucherRepository->delete($id);

        return redirect()->back();
    }

    // show information voucher
    public function show(int $id)
    {
        $check_voucher = true;
        $vouchers = $this->voucherRepository->find($id);

        return view('admin.voucher.show_voucher', compact('vouchers', 'check_voucher'));
    }

    // update information voucher
    public function update(int $id, EditVoucherFormRequest $request)
    {
        $this->voucherRepository->update($id, $request->toArray());

        return redirect()->route('list_voucher');
    }
}
