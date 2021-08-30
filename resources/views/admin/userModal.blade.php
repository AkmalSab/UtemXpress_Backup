<!-- Show Image Modal -->
<div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personal Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->user_picture}}" class="img-fluid" alt="personal_image">
            </div>
        </div>
    </div>
</div>
<!-- Show Image Modal -->

<!-- Show IC Front Image Modal -->
<div class="modal fade" id="showIcFront" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IC Front Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->user_nric_picture_front}}" class="img-fluid" alt="showIcFront">
            </div>
        </div>
    </div>
</div>
<!-- Show IC Front Image Modal -->

<!-- Show IC Back Image Modal -->
<div class="modal fade" id="showIcBack" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IC Back Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->user_nric_picture_back}}" class="img-fluid" alt="showIcBack">
            </div>
        </div>
    </div>
</div>
<!-- Show IC Back Image Modal -->
