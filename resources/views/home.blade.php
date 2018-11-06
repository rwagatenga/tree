@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    @foreach($views as $view)
                    <a href="{{url('/again/'.$view->id)}}">Share this link</a>
                    <a data-href="/agin/{{$view->id}}" data-toggle="modal" data-target="#myModal">Hello</a>
                    @endforeach
                    <h3>Category List</h3>
                    
                   <ul>
                  <!-- @foreach ($categories as $parent)
                    <li>{{ $parent->title }}
                      @if ($parent->childs->count())
                        <ul>
                          @foreach ($parent->childs as $child)
                            <li>{{ $child->title }}</li>
                          @endforeach
                        </ul>
                      @endif
                    </li>
                  @endforeach -->
              </ul>
                        <ul id="tree1">
                            @foreach($categories as $category)
                                <li>
                                    {{ $category->title }}
                                    @if(count($category->childs))
                                        @include('manageChild',['childs' => $category->childs])
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
