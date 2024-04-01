@extends('layouts.app')
@section('content')

    @include('layouts.top-header', [
        'title' => __('Category'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Category table') }}</span>
                        <button class="btn btn-primary addbtn float-right p-2 add_cat" id="add_cat"><i
                                class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('Image') }}</th>
                                    <th scope="col" class="sort">{{ __('Category') }}</th>
                                    <th scope="col" class="sort">{{ __('Color') }}</th>
                                    <th scope="col" class="sort">{{ __('Status') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($categories) != 0)
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <th>{{ $categories->firstItem() + $key }}</th>
                                            <td>
                                                <img alt="Image placeholder" class="tableimage_cat rounded"
                                                    src="{{ asset('storage/images/categories/' . $category->image) }}">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="color-box"
                                                    style="background-color: {{ $category->color_name }}">
                                                    <p style="color: {{ $category->color_name }}">
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="custom-toggle">
                                                    <input type="checkbox" onchange="hideCategory({{ $category->cat_id }})"
                                                        {{ $category->status == 0 ? 'checked' : '' }}>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Hide"></span>
                                                </label>
                                            </td>
                                            <td class="table-actions">
                                                @php
                                                    $base_url = url('/');
                                                @endphp
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    onclick="edit_cat({{ $category->cat_id }},'{{ $base_url }}')"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit category') }}">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">{{ __('No Categories') }}</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="float-right  mr-4 mb-1">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.category.create')
    @include('admin.category.edit')
@endsection
