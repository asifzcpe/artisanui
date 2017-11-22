<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtisanUiRequest;
use Illuminate\Http\Request;

class ArtisanUi extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('artisanui.layouts');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$serverPath='c:/wamp/www/';
		$directories=scandir($serverPath);
		return view('artisanui.generate',compact('directories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArtisanUiRequest $request)
	{
		$fileName=$request->input('file_name');
		$fileType=$request->input('file_type');
		switch($fileType)
		{
			case 'controller';
			\Artisan::call('make:controller',['name'=>$fileName]);
			$this->transferGeneratedFile($fileName,$fileType);
			break;

			case 'model';
			\Artisan::call('make:model',['name'=>$fileName]);
			break;

			case 'request';
			\Artisan::call('make:request',['name'=>$fileName]);
			break;

			case 'event';
			\Artisan::call('make:event',['name'=>$fileName]);
			break;

			case 'migration';
			\Artisan::call('make:migration',['name'=>$fileName]);
			break;

			case 'serviceProvider';
			\Artisan::call('make:provider',['name'=>$fileName]);
			break;
			
		}

		return redirect('artisanui/generate');
		
	}

	private function transferGeneratedFile($fileName,$fileType)
	{
		if(isset($fileName) && isset($fileType))
		{
			$projectPath='c:/wamp/www/';
			copy('app/Http/Controllers/'.$fileName.'.php','../tuts/app/Http/Controllers/'.$fileName.'.php');
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
