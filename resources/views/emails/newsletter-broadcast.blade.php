@extends('emails.layout', ['subject' => $subjectLine, 'email' => $email, 'token' => $token])

@section('content')
    <div class="custom-content">
        {!! $htmlContent !!}
    </div>
@endsection
