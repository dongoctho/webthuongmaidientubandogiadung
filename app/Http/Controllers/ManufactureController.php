<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Http\Requests\CreateManufactureFormRequest;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    protected $manufactureRepository;

    public function __construct(ManufactureRepositoryInterface $manufactureRepositoryInterface)
    {
        $this->manufactureRepository = $manufactureRepositoryInterface;
    }

    public function index()
    {
        return view('admin.manufacture.add_manufacture');
    }

    public function create(CreateManufactureFormRequest $request)
    {
        $data = [
            'code' => $request->code,
            'description' => $request->description,
            'name' => $request->name
        ];

        $this->manufactureRepository->create($data);

        return view('admin.manufacture.add_manufacture')->with('msg', 'Created');
    }

    public function list()
    {
        $manufactures = $this->manufactureRepository->getAll();

        return view('admin.manufacture.list_manufacture', [
            'manufactures' => $manufactures
        ]);
    }

    public function destroy(int $id)
    {
        $this->manufactureRepository->delete($id);

        return redirect()->back();
    }

    public function show(int $id)
    {
        $manufactures = $this->manufactureRepository->find($id);

        return view('admin.manufacture.show_manufacture', [
            'manufactures' => $manufactures
        ]);
    }

    public function update(int $id, CreateManufactureFormRequest $request)
    {

        $this->manufactureRepository->update($id, $request->toArray());

        return redirect()->route('list_manufacture');
    }
}
