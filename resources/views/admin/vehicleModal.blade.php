<!-- Show Vehicle Image Modal -->
<div class="modal fade" id="showVehicle" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Vehicle Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->vehicle_picture}}" class="img-fluid" alt="showIcBack">
            </div>
        </div>
    </div>
</div>
<!-- Show Vehicle Image Modal -->

<!-- Show Roadtax Image Modal -->
<div class="modal fade" id="showRoadtax" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Roadtax Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->vehicle_roadtax_picture}}" class="img-fluid" alt="showIcBack">
            </div>
        </div>
    </div>
</div>
<!-- Show Roadtax Image Modal -->
