<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Http\Controllers\Administrator;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Form;
use App\Http\Requests\Administrator\UserRequest;
use App\Handlers\UploadHandler;

/**
 * 用户操作控制器
 *
 * Class UserController
 * @package App\Http\Controllers\Administrator
 */
class FormController extends Controller
{
    public $type = '';

    public function __construct(Request $request)
    {
        $this->type = $request->route('type') ?  '.'.$request->route('type') : '';
        static::$activeNavId = 'content.form' . strtolower($this->type);
    }


    public function index($type, Form $form, Request $request)
    {
//        $this->authorize('index', $form);

        $forms = $form->where('form', strtolower($type))->with(['user'])->recent()->paginate(config('administrator.paginate.limit'));

        if( $forms->count() < 1 && $forms->lastPage() > 1 ){
            return redirect($forms->url($forms->lastPage()));
        }

        $form = config('form.structure.'.$type);

        return backend_view('form.index', compact('forms', 'type', 'form'));
    }

    /**
     * @param Form $form
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Form $form){
//        $this->authorize('show', $form);
        $type = strtolower($form->form);
        $structure = config('form.structure.'.$type);

        return backend_view('form.show', compact('form', 'type', 'structure'));
    }

    /**
     * @param Form $form
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Form $form){
//        $this->authorize('destroy', $form);
        $form->delete();
        return $this->redirect()->with('success', '删除成功.');
    }





}
