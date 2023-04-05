<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherFormRequest;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;

class VoucherController extends Controller
{
    protected $voucherRepository;
    protected $productRepository;

    public function __construct(VoucherRepositoryInterface $voucherRepositoryInterface,
    ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->voucherRepository = $voucherRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('admin.voucher.add_voucher', [
            'products' => $products
        ]);
    }

    public function create(CreateVoucherFormRequest $request)
    {
        $products = $this->productRepository->getAll();

        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'voucher_type' => $request->voucher_type,
        ];

        $this->voucherRepository->create($data);

        return view('admin.voucher.add_voucher')->with('msg', 'Created');
    }

    public function list()
    {
        $vouchers = $this->voucherRepository->getAll();

        return view('admin.voucher.list_voucher', [
            'vouchers' => $vouchers
        ]);
    }

    public function destroy(int $id)
    {
        $this->voucherRepository->delete($id);

        return redirect()->back();
    }

    public function show(int $id)
    {
        $vouchers = $this->voucherRepository->find($id);

        return view('admin.voucher.show_voucher', [
            'vouchers' => $vouchers
        ]);
    }

    public function update(int $id, CreateVoucherFormRequest $request)
    {
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'voucher_type' => $request->voucher_type
        ];

        $this->voucherRepository->update($id, $data);

        return redirect()->route('list_voucher');
    }
}
