<button type="button" class="btn btn-primary" data-toggle="modal" data-style="zoom-in" data-target="#addColumnModal">
    <span class="ladda-label"><i class="la la-plus"></i> Add Column</span>
</button>

@section('modal')
    @push('after_scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
<!-- Modal -->
<div class="modal fade" id="addColumnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a custom column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="columnName" class="col-form-label">Column name:</label>
                    <input type="text" class="form-control" name="columnName" id="columnName">
                    <small id="columnNameError" class="text-danger">
                    </small>
                </div>
                <div class="form-group">
                    <label for="ColumnType" class="col-form-label">Type:</label>
                    <select class="form-control" name="columnType" id="columnType">
                        <option value="1">Text</option>
                    </select>
                    <small id="columnTypeError" class="text-danger">
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit">Add Column</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submit').addEventListener('click', function(){
        createColumn();
    });

    function createColumn(){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let url = '{{route('addColumn')}}';
        var body = {
            columnName: document.getElementById('columnName').value,
            columnType: document.getElementById('columnType').value,
        };
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify(body)
        }).then((response) => {
                return response.json();
            }).then((data) => {
                console.log(data);
            if(data.success){
                clearFields();
                clearValues();
                closeModal();
                Swal.fire(
                    'Column added!',
                    '',
                    'success'
                ).then(()=>{
                    location.reload();
                });
            }
            else if(!data.success && data.exception){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.exceptionMessage ? data.exceptionMessage : 'Some code seems to be broken...',
                    footer: 'Contact the developer.'
                })
            }
            else{
                clearFields();
                for(property in data.errors){
                    document.getElementById(property+'Error').innerText = data.errors[property];
                }
            }
        }).catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message,
                    footer: 'Contact the developer.'
                })
            });
    }

    function clearFields(fields = ['columnNameError', 'columnTypeError']){
        fields.forEach(function(value){
            document.getElementById(value).innerText = "";
        })
    }

    function clearValues(fields = ['columnName']){
        fields.forEach(function(value){
            document.getElementById(value).value = "";
        })
    }
    function closeModal(){
        let modal = document.getElementById('addColumnModal');
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        modal.setAttribute('style', 'display: none');

        let modalsBackdrops = document.getElementsByClassName('modal-backdrop');
        modalsBackdrops.forEach(function(value){
            document.body.removeChild(value);
        });
    }

</script>

@endsection
