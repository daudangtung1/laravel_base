<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RepositoryInterface;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(RepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $post = $this->postRepository->getAll();
        dd($post);
    }

    public function getLastest()
    {
        $post = $this->postRepository->getPostHost();
        dd($post);
    }

    public function show($id)
    {
        $show = $this->postRepository->show($id);
        dd($show);
    }

    public function create()
    {
        return view('post.partials.create');
    }

    public function store(Request $request)
    {
        $data_input = $request->only('text', 'content');
        $this->postRepository->store($data_input);
        return redirect()->route('post.index');
    }

    public function edit(Request $request, $id)
    {
        $data = $this->postRepository->getById($id);
        return view('post.partials.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data_change = $request->only('text', 'content');
        $this->postRepository->update($data_change, $id);
        return redirect()->route('post.index');
    }

    public function delete($id)
    {
        $this->postRepository->delete($id);
        return redirect()->route('post.index');
    }
}
