<section class="about-section">
    <div class="container pt-106">
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-2">
                <div class="page-header">
                    <p class="mb-0">ჩვენ შესახებ</p>
                </div>

            </div>
            <div class="col-12 d-flex justify-content-center pb-2">
                <div class="page-desc">
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem quos facere placeat!</p>
                </div>

            </div>
            <div class="col-12">
                <table class="table table-striped w-100">
                    <thead class="rounded-table-header">
                        <tr class="rounded-table-row">
                            <th class="rounded-table-heading-left"><p class="mb-0 ">ფილიალი</p></th>
                            <th>მისამართი</th>
                            <th>ტელეფონი</th>
                            <th class="whites-space-nowrap">ფილიალის გამგე</th>
                            <th class="whites-space-nowrap">ვაკანსია 2-3 წ.</th>
                            <th class="whites-space-nowrap">ვაკანსია 3-4 წ.</th>
                            <th class="whites-space-nowrap">ვაკანსია 4-5 წ.</th>
                            <th class="rounded-table-heading-right whites-space-nowrap">ვაკანსია 5-6 წ.</th>
                        </tr>
                    </thead>
                    <tbody>
                                                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ route('retrieveBranchesWithGroups') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(branches){
                let count = 0;
                let output = '';
                console.log(branches.length)
                branches.forEach(branch => {
                    count++;
                    output += `
                        <tr class="single-branch">
                            <td class="${count == 1 ? 'rounded-table-heading-left' : null} branch-name"><p class="mb-0 ">${branch.name}</p></td>
                            <td class="address">${branch.address}</td>
                            <td class="phone">${branch.phone}</td>
                            <td class="manager-name">${branch.branch_manager}</td>
                            ${branch.kindergarden_branch_kindergarden_groups.map((el) => {
                               return `<td class="groups">${el.vacancy}</td>`
                            })}
                        </tr>
                    `;
                });
                $('tbody').append(output);
            }
        });
    });
</script>