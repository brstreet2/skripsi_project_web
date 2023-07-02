@extends('errors.error')

@section('code', 'Forbidden')
@section('title', __('Unauthorized'))

@section('message', __($exception->getMessage() ?: 'Sorry, you are forbidden from accessing this page.'))
