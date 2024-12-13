@extends('layouts.app')
@section('title', $page->name)

@section('content')
     <!-- page-title -->
     <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">{{ $page->name }}</div>
                    <p class="text-center text-2 text_black-2 mt_5">{{ $page->desc }}</p> 
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->
    <section class="flat-spacing-1">
        <div class="container">
            
            {!! $page->content !!}
            
        </div>       
    </div>
    <!-- End Filter -->
    <style>
        .box{
            margin-bottom: 24px;
        }
        .box p{
            text-align: justify;
        }
        .box h4{
            font-size: 22px;
            font-weight: 500;
            line-height: 50.4px;
        }
    </style>
@endsection