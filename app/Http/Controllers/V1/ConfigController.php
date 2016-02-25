<?php


namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    protected $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function index()
    {
        return $this->configRepository->all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $name   = $request->get('name');
        $value  = $request->get('value');

        $this->configRepository->setForName($name, $value);

        return [
            'name'  => $name,
            'value' => $this->show($name)
        ];
    }

    public function show($name)
    {
        return [
            'name'  => $name,
            'value' => $this->configRepository->getByName($name)
        ];
    }

    public function destroy($name)
    {
        $deleted = $this->configRepository->deleteByName($name);

        if ($deleted) {
            return [
                'status' => 'success',
                'message' => 'Config deleted.'
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => 'Config not found.'
            ];
        }
    }
}