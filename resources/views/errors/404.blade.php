@extends('errors::error')

@section('code', '404')
@section('title', __('Forbidden'))

@section('message', __($exception->getMessage() ?: 'Not Found.'))
