@extends('errors.error')

@section('code', '429')
@section('title', __('Too Many Requests'))

@section('message', __('Maaf, anda terlalu banyak membuat permintaan pada server kami.'))
