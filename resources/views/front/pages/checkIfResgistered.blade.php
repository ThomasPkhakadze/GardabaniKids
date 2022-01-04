<div class="container center-vertically pt-60">
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="section-header">
                <p class="mb-0">შეიყვანეთ პირადი ნომერი</p>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 br-46 bg-dark-blue py-4 px-5">
            <div class="form-continer">
                <div class="row px-5 h-100">
                    <div class="col-12 mb-3 d-flex">
                        <input id="id_number" type="text" name="search" class="d-inline-block w-100">
                        <div class="bg-bluish d-inline float-end ms-3 cursor-pointer bg-darker-blue p-1 txt-graysh">
                            <p id="search-btn" type="submit"  class="d-inline mb-0">ძებნა</p>
                        </div>
                    </div>
                    <div id="search-result" class="col-12">
                        <div class="col-12 d-flex mb-3">
                            <div class="txt-graysh me-3">
                                <p class="mb-0 ">სახელი</p>
                            </div>
                            <div class="text-center bg-greysh br-23 w-100">
                                <p id="name" class="mb-0 txt-bluish py-3 "></p>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="txt-graysh me-3">
                                <p  class="mb-0">გვარი</p>
                            </div>
                            <div class="text-center bg-greysh br-23 w-100">
                                <p id="lastname" class="mb-0 txt-bluish py-3 "></p>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="txt-graysh me-3">
                                <p class="mb-0">ბაღი</p>
                            </div>
                            <div class="text-center bg-greysh br-23 w-100">
                                <p id="branch" class="mb-0 txt-bluish py-3 "></p>
                            </div>
                        </div>
                    </div>
                    <div id="not-found" class="d-none">
                        <h4 class="txt-graysh">თქვენს მიერ შეყვანილი მონაცემებით ბავშვი ვერ მოიძებნა!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    $('#search-btn').on('click', function(){
        let data = {
            id_number : $('#id_number').val(),
            "_token": "{{ csrf_token() }}"            
        }
        console.log(data);
        if(data.id_number != ''){
            $.ajax({
                url: "{{ route('checkIfRegistered') }}",
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(res){
                    console.log(res, res.status)
                    if(res.status == 'Found'){
                        $("#name").html(res.kid.name)
                        $("#lastname").html(res.kid.lastname)
                        $("#branch").html(res.kid.branch)
                    }else{
                        $("#search-result").hide();
                        $("#not-found").removeClass('d-none');
                    }
                }
            });
        }
    });
</script>
