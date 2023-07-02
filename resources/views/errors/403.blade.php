@extends('errors.error')

@section('code', 'Forbidden')
@section('title', __('Unauthorized'))

@section('message', __($exception->getMessage() ?: 'Maaf, anda dilarang untuk mengakses halaman ini.'))
