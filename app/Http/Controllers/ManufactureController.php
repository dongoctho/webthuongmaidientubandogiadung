<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Http\Requests\CreateManufactureFormRequest;
use App\Http\Requests\EditManufactureFormRequest;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    protected $manufactureRepository;

    public function __construct(ManufactureRepositoryInterface $manufactureRepositoryInterface)
    {
        $this->manufactureRepository = $manufactureRepositoryInterface;
    }

    // show manufacture page
    public function index()
    {
        $check_manufacture = true;
        return view('admin.manufacture.add_manufacture', compact('check_manufacture'));
    }

    // create manufacture to database
    public function create(CreateManufactureFormRequest $request)
    {
        $data = [
            'code' => $request->code,
            'description' => $request->description,
            'name' => $request->name
        ];

        $this->manufactureRepository->create($data);

        return redirect()->route('list_manufacture')->with('msg', 'Created');
    }

    // show list manufacture
    public function list(Request $request)
    {
        $check_manufacture = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;
        $manufactures = $this->manufactureRepository->getManufactureByCondition($data);

        return view('admin.manufacture.list_manufacture', compact('manufactures', 'key', 'data', 'check_manufacture'));
    }

    // delete manufacture
    public function destroy(int $id)
    {
        $this->manufactureRepository->delete($id);

        return redirect()->back();
    }

    // show information manufacture
    public function show(int $id)
    {
        $check_manufacture = true;
        $manufactures = $this->manufactureRepository->find($id);

        return view('admin.manufacture.show_manufacture', compact('manufactures', 'check_manufacture'));
    }

    // update information manufacture
    public function update(int $id, EditManufactureFormRequest $request)
    {
        $this->manufactureRepository->update($id, $request->toArray());

        return redirect()->route('list_manufacture');
    }
}
