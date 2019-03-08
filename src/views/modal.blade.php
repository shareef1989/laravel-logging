<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Show Diffrent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-center text-primary">Befor</h3>
                    <hr>
                    @foreach(collect($befor)->toArray() as $key=>$value)
                        <p class="p-1"><span class="font-weight-bold text-info">{{$key}}</span> : <span>{{$value}}</span></p>
                    @endforeach
                </div>
                <div class="col-md-6" style="border-left:1px solid">
                    <h3 class="text-center text-primary">After</h3>
                    <hr>
                    @foreach(collect($after)->toArray() as $key=>$value)
                        <p  class="p-1 @if(is_object($befor) && $befor->$key != $value) bg-warning text-light @endif" ><span class="font-weight-bold text-info">{{$key}}</span> : <span>{{$value}}</span></p>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
