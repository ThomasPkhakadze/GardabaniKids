<div class="container center-vertically pt-60">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="section-header">
                <p class="mb-0">რეგისტრაცია</p>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 br-46 bg-dark-blue py-4 px-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                    <div class="col-12">
                        <p class="mb-2 txt-graysh">მშობელი ან მეურვე</p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control br-23" id="parent_name" placeholder="name@example.com">
                                <label for="parent_name">სახ.გვარი</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control br-23" id="parent_id_number" placeholder="name@example.com">
                                <label for="parent_id_number">პირადი ნომერი</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select br-23" id="floatingSelectGuardian" aria-label="Floating label select example">
                                <option value="დედა">დედა</option>
                                <option value="მამა">მამა</option>
                                <option value="მეურვე">მეურვე</option>
                            </select>
                            <label for="floatingSelectGuardian">აირჩიეთ მეურვის ტიპი</label>
                        </div>
                        <div class="form-floating mb-3">                            
                            <input type="text" class="form-control br-23" id="phone" placeholder="name@example.com">
                                <label for="phone">ტელ.ნომერი</label>
                        </div>
                        <div class="form-floating mb-3">                            
                            <input type="email" class="form-control br-23" id="email" placeholder="name@example.com">
                                <label for="email">ელ-ფოსტა</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                    <div class="col-12">
                        <p class="mb-2 txt-graysh">ბავშვი</p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control br-23" id="name" placeholder="name@example.com">
                                <label for="name">სახ.გვარი</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control br-23" id="id_number" placeholder="name@example.com">
                                <label for="id_number">პირადი ნომერი</label>
                        </div>
                        <div class="form-floating mb-3">                            
                            <input type="text" class="form-control br-23" id="date_of_birth" placeholder="name@example.com">
                                <label for="date_of_birth">დაბადების თარიღი</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select br-23" id="floatingSelectBranches" aria-label="Floating label select example">
                            </select>
                            <label for="floatingSelectBranches">ბაღის ფილიალი</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select br-23" id="floatingSelectGroups" aria-label="Floating label select example">
                            </select>
                            <label for="floatingSelectGroups">ფილიალის ჯგუფები</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center bg-greysh br-23 cursor-pointer">
                        <p id="form-submit" type="submit" class="mb-0 d-inline-block txt-bluish w-100 py-3 cursor-pointer">გაგრძელება</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#form-submit").on('click', function() {
        const kidFullname = fullNameSplit($("#name").val());
        const parentFullname = fullNameSplit($("#parent_name").val());
        let data = {
            'parent_id_number' : $("#parent_id_number").val(),
            'guardian_type' : $("#floatingSelectGuardian").find(':selected').val(),
            'phone' : $("#phone").val(),
            'email' : $("#email").val(),
            'parent_name' : parentFullname.name,
            'parent_lastname' : parentFullname.lastname,           
            'id_number' : $("#id_number").val(),
            'name' : kidFullname.name,
            'lastname' : kidFullname.lastname,
            'date_of_birth' : $("#date_of_birth").val(),
            'branch_id' : $("#floatingSelectBranches").find(':selected').val(),
            'group_id' : $("#floatingSelectGroups").find(':selected').val(),   
            "_token": "{{ csrf_token() }}"

        }
        console.log(data);
        $.ajax({
            url: "{{ route('register') }}",
            method: "POST",
            data: data,
            dataType: "json",
            success: function(res){
               console.log(res);
            },
            error: function(err){
               alert(JSON.stringify(err));
            }   
        });
    });
    $("#floatingSelectBranches").change(() => {
        const selectedBranchId = $("#floatingSelectBranches").find(":selected").val();
          let data = {
            'id' : selectedBranchId,
            "_token": "{{ csrf_token() }}"
        }
        // console.log(data);
        $.ajax({
            url: "{{ route('getBranchGroups') }}",
            method: "POST",
            data: data,
            dataType: "json",
            success: function(res){
                const arr = Object.entries(res); 
                    $('#floatingSelectGroups').empty();
               arr.forEach(element => {
                    $('#floatingSelectGroups').append(`<option value="${element[1]}">${element[0]}</option>`)
               });
            },
            error: function(err){
               alert(JSON.stringify(err));
            }   
        });
    });
    $(document).ready(function(){
          let data = {
            'page' : 0,
            "_token": "{{ csrf_token() }}"
        }
      //   console.log(data);
        $.ajax({
            url: "{{ route('getBranches') }}",
            method: "POST",
            data: data,
            dataType: "json",
            success: function(res){
                const arr = Object.entries(res); 
               arr.forEach(element => {
                    $('#floatingSelectBranches').append(`<option value="${element[1]}">${element[0]}</option>`)
               });
            },
            error: function(err){
               alert(JSON.stringify(err));
            }   
        });
        $("#date_of_birth").datepicker({ dateFormat: 'yy-mm-dd' });

    });

    function fullNameSplit(fullName)
    {
        console.log(fullName);  
        const name = fullName.split(' ')[0]; 
        const lastname = fullName.split(' ')[1]; 

        return {'name': name,'lastname': lastname}
    }


</script>