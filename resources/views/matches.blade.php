@extends('layouts.mainlayout')

@section('content')
    @if($matches !== "none")
    <div class="card-group">
    @foreach ($matches as $match)
    <div class="card"><img class="card-img-top w-100 d-block">
        <div class="card-body">
            <h4 class="card-title">{{$match['name']}}</h4>
            <div class="card-text">
                <strong>Bio:</strong>
                <p id='user-bio'>{{$match['bio']}}</p>
                <strong>Interests:</strong>
                <p id='user-interests'>{{$match['interests']}}</p>
                <strong>Preference:</strong>
                <p id='user-preference'>{{$match['preference']}}</p>
            </div>
            <button class="btn btn-primary" type="button" onclick="$('#noChatModal').modal('show');">Chat</button></div>
    </div>
    <div class="modal fade" id="noChatModal" tabindex="-1" role="dialog" aria-labelledby="noChatModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="noChatModal-title modal-title">Still in development...</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="noChatModal-body modal-body">
                    There's sadly no chat function yet. But, I promise you, it's being worked on.<br>
                    For now, contact your match on Facebook, or find them in person.
                </div>
                <div class="noChatModal-footer modal-footer">
                    <button type="button" class="btn btn-success"
                        onclick="$('#noChatModal').modal('hide');">Alright</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else <div style="text-align: center;" class="alert alert-danger align-content-center"><b>Oh no!</b> You haven't matched with anyone yet! Keep looking, and come back here to find your matches.
        @endif
</div>
@endsection
