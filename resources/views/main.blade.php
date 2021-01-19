@extends('layouts.mainlayout')

@section('content')
    <script src="/assets/js/MatchesAjax.js"></script>
    <div class="user-info-container" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="mainModal"
        aria-hidden="false">
        <div class="modal-dialog user-info" role="document">
            <div class="modal-content user-info">
                <div class="user-info-body modal-body" id="user-info" style="display:none">
                    <strong>Bio:</strong>
                    <p id='user-bio'></p>
                    <strong>Interests:</strong>
                    <p id='user-interests'></p>
                    <strong>Preference:</strong>
                    <p id='user-preference'></p>
                </div>
                <div class="user-info-body modal-body" id="loading">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer buttons">
                    <button type="button" id='yay-btn' class="btn btn-success" onclick="SendResponse('yay')"> Yeah</button>
                    <button type="button" id='nay-btn' class="btn btn-danger" onclick="SendResponse('nay')">Nah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="matchModal" tabindex="-1" role="dialog" aria-labelledby="matchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="matchModal-title modal-title">It's a match!!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="matchModal-body modal-body">
                    You shouldn't be seeing this, you cheeky hacker, you.
                </div>
                <div class="matchModal-footer modal-footer">
                    <button type="button" class="btn btn-success"
                        onclick="$('#matchModal').modal('hide');loadDoc()">Great!</button>
                </div>
            </div>
        </div>
    </div>
@endsection
