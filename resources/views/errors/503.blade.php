@extends('errors.error')

@section('code', '503')
@section('title', __('Service Unavailable'))

@section('message', __($exception->getMessage() ?: 'Maaf, kami sedang melakukan pemeliharaan. Silahkan kembali beberapa
    saat lagi.'))
