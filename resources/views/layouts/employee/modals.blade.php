<div class="modal fade exampleModal" id="viewDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <document-view @status="message" ref="viewDocument"></document-view>
</div>

<div class="modal fade exampleModal" id="viewTravel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <travel-view :statuses="{{ json_encode($statuses) }}" :profile="{{ json_encode($profile) }}" @status="message" ref="viewTravel"></travel-view>
</div>