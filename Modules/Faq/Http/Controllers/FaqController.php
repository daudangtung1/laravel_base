<?php

namespace Modules\Faq\Http\Controllers;

use App\Trait\ResponseTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faq\Services\FaqService;

class FaqController extends Controller
{
    use ResponseTrait;

    protected $module = 'faq';
    protected $faqService;

    public function __construct(
        FaqService $faqService
    ) {
        $this->faqService = $faqService;
    }

    public function index()
    {
        return view($this->module . '::index');
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'question',
            'answer',
            'is_published',
        ]);
        $data = $this->faqService->store($input);
        return $this->responseSuccess($data, 'Create faq success');
    }

    public function show($id)
    {
        return view('faq::show');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
