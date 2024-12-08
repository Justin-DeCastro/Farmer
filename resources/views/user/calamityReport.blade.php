<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agtech</title>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

        <!-- DataTables JS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <style>
            .background-container {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                padding: 20px 10px;
                background: url('images/farner.webp') no-repeat center center;
                background-size: cover;
            }

            .feedback-table {
                max-width: 100%;
                width: 100%;
                padding: 20px;
                background-color: rgba(249, 249, 249, 0.3);
                backdrop-filter: blur(5px);
                color: #333;
            }

            .btn-submit {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                cursor: pointer;
            }

            .btn-submit:hover {
                background-color: #0056b3;
            }

            .btn-print {
                background-color: #28a745;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                cursor: pointer;
                margin-bottom: 20px;
            }

            .btn-print:hover {
                background-color: #218838;
            }

            @media (max-width: 768px) {
                .btn-submit {
                    width: 100%;
                    margin-bottom: 10px;
                }
                .feedback-table h3 {
                    font-size: 1.5rem;
                }
            }

            @media (max-width: 576px) {
                .modal-content {
                    padding: 10px;
                }
            }
        </style>
    </head>
<body>

    @include('Components.User.header')
    @include('Components.User.sidebar')

    <div class="main-panel">
        <div class="background-container">
            <div class="feedback-table">
                <h3 class="fw-bold mb-3">Calamity Reports</h3>
                <!-- Existing Export Buttons -->
                <button class="btn-submit" data-bs-toggle="modal" data-bs-target="#calamityReportModal">Submit Report</button>

                <!-- New Print Report Button -->
                <button class="btn-print" onclick="printReport()">Generate Report</button>

                <div class="table-responsive mt-3">
                    <table id="calamityReportsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Farmer Name</th>
                                <th>Birthdate</th>
                                <th>Region</th>
                                <th>Province</th>
                                <th>Municipality</th>
                                <th>Barangay</th>
                                <th>Calamity</th>
                                <th>Farmer Type</th>
                                <th>RSBSA Ref Number</th>
                                <th>Crops or Livestocks</th>
                                <th>Farm Type</th>
                                <th>Animal Type</th>
                                <th>Age Classification</th>
                                <th>No. of Heads</th>
                                <th>Damage Area</th>
                                <th>Total Area</th>
                                <th>Sex</th>
                                <th>Tribe Name</th>
                                <th>PWD</th>
                                <th>ARB</th>
                                <th>4Ps</th>
                                <th>Male Count</th>
                                <th>Female Count</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calamityReport as $report)
                                <tr>
                                    <td>{{ $report->first_name }} {{ $report->middle_name }} {{ $report->surname }} {{ $report->extension_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->birthdate)->format('F d, Y') }}</td>
                                    <td>{{ $report->region }}</td>
                                    <td>{{ $report->province }}</td>
                                    <td>{{ $report->municipality }}</td>
                                    <td>{{ $report->barangay }}</td>
                                    <td>{{ $report->calamity }}</td>
                                    <td>{{ $report->farmer_type }}</td>
                                    <td>{{ $report->rsbsa_ref_number }}</td>
                                    <td>{{ $report->crops_or_livestocks }}</td>
                                    <td>{{ $report->farm_type }}</td>
                                    <td>{{ $report->animal_type }}</td>
                                    <td>{{ $report->age_classification }}</td>
                                    <td>{{ $report->no_of_heads }}</td>
                                    <td>
                                        Partial: {{ $report->partial_damage_area }}<br>
                                        Total: {{ $report->totally_damage_area }}
                                    </td>
                                    <td>{{ $report->total_area }}</td>
                                    <td>{{ $report->sex }}</td>
                                    <td>{{ $report->tribe_name }}</td>
                                    <td>{{ $report->pwd ? 'Yes' : 'No' }}</td>
                                    <td>{{ $report->arb ? 'Yes' : 'No' }}</td>
                                    <td>{{ $report->four_ps ? 'Yes' : 'No' }}</td>
                                    <td>{{ $report->male_count }}</td>
                                    <td>{{ $report->female_count }}</td>
                                    <td>
                                        @if($report->status == 'Pending')
                                            <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                                        @elseif($report->status == 'Canceled')
                                            <span class="badge bg-danger text-white">{{ $report->status }}</span>
                                        @elseif($report->status == 'Accepted')
                                            <span class="badge bg-success text-white">{{ $report->status }}</span>
                                        @else
                                            <span class="badge bg-secondary text-white">{{ $report->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(is_array($report->proof_images) && count($report->proof_images) > 0)
                                            @foreach($report->proof_images as $image)
                                                <img src="{{ asset($image) }}" alt="Proof Image" width="100" height="100">
                                            @endforeach
                                        @elseif(is_string($report->proof_images) && !empty($report->proof_images))
                                            <img src="{{ asset($report->proof_images) }}" alt="Proof Image" width="100" height="100">
                                        @else
                                            No Image Available
                                        @endif
                                    </td>


                                    <td>
                                        <form action="{{ route('calamity-report.delete', $report->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                        </form>
                                        <form action="{{ route('calamity-report.cancel', $report->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to cancel this report?')">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="calamityReportModal" tabindex="-1" aria-labelledby="calamityReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="calamityReportModalLabel">Submit Calamity Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Content -->
                    <form action="{{ route('calamity-report.store') }}" method="post" id="profileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Calamity -->
                            <div class="col-md-4 mb-3">
                                <label for="calamity">Calamity</label>
                                <input type="text" id="calamity" name="calamity" class="form-control" value="{{ old('calamity') }}" required>
                                @error('calamity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Type of Affected Farmer -->
                            <div class="col-md-4 mb-3">
                                <label for="farmerType">Type of Affected Farmer</label>
                                <select id="farmerType" name="farmerType" class="form-control" required onchange="toggleFields()">
                                    <option value="" disabled selected>Select one...</option>
                                    <option value="individual">Individual</option>
                                    <option value="group">Group</option>
                                    <option value="indigenous">Indigenous</option>
                                </select>
                                @error('farmerType')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- RSBSA Reference Number -->
                            <div class="col-md-4 mb-3">
                                <label for="rsbsaRefNumber">RSBSA Reference Number</label>
                                <input type="text" id="rsbsaRefNumber" name="rsbsaRefNumber" class="form-control" value="{{ old('rsbsaRefNumber') }}">
                                @error('rsbsaRefNumber')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    <!-- Crops or Livestocks -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cropsOrLivestocks">Crops or Livestocks</label>
                            <select id="cropsOrLivestocks" name="cropsOrLivestocks" class="form-control" required onchange="toggleFields()">
                                <option value="" disabled selected>Select one...</option>
                                <option value="crops">Crops</option>
                                <option value="livestocks">Livestocks</option>
                            </select>
                            @error('cropsOrLivestocks')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="proofImages">Proof of Damage (Images)</label>
                            <input type="file" id="proofImages" name="proofImages[]" class="form-control" accept="image/*" multiple required>
                            @error('proofImages')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea id="remarks" name="remarks" class="form-control">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <!-- Dynamic Fields for Crops -->
                    <div id="cropsFields" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="partialDamageArea">Partially Damaged Area</label>
                                <input type="text" id="partialDamageArea" name="partialDamageArea" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="totallyDamageArea">Totally Damaged Area</label>
                                <input type="text" id="totallyDamageArea" name="totallyDamageArea" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="totalArea">Total Area</label>
                                <input type="text" id="totalArea" name="totalArea" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Fields for Livestocks -->
                    <div id="livestocksFields" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="farmType">Type of Farm</label>
                                <select id="farmType" name="farmType" class="form-control">
                                    <option value="backyard">Backyard</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="semi-commercial">Semi-Commercial</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="animalType">Animal Type</label>
                                <input type="text" id="animalType" name="animalType" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="ageClassification">Age Classification</label>
                                <input type="text" id="ageClassification" name="ageClassification" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="noOfHeads">No. of Heads</label>
                                <input type="number" id="noOfHeads" name="noOfHeads" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- Personal Information Section (Visible only for Individual type) -->
                    <div id="personalInfo" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="surname">Surname</label>
                                <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname') }}">
                                @error('surname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="extension_name">Extension Name</label>
                                <input type="text" id="extension_name" name="extension_name" class="form-control" value="{{ old('extension_name') }}">
                                @error('extension_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
                                @error('birthdate')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="region">Region</label>
                                <input type="text" id="region" name="region" class="form-control" value="{{ old('region') }}">
                                @error('region')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="municipality">Municipality</label>
                                <input type="text" id="municipality" name="municipality" class="form-control" value="{{ old('municipality') }}">
                                @error('municipality')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" class="form-control" value="{{ old('province') }}">
                                @error('province')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="barangay">Barangay</label>
                                <input type="text" id="barangay" name="barangay" class="form-control" value="{{ old('barangay') }}">
                                @error('barangay')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Group Information Section (Visible only for Group type) -->
                    <div id="groupInfo" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="orgName">Organization Name</label>
                                <input type="text" id="orgName" name="orgName" class="form-control" value="{{ old('orgName') }}">
                                @error('orgName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="maleCount">Male Count</label>
                                <input type="number" id="maleCount" name="maleCount" class="form-control" value="{{ old('maleCount') }}">
                                @error('maleCount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="femaleCount">Female Count</label>
                                <input type="number" id="femaleCount" name="femaleCount" class="form-control" value="{{ old('femaleCount') }}">
                                @error('femaleCount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Indigenous Information Section (Visible only for Indigenous type) -->
                    <div id="indigenousInfo" style="display: none;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="sex">Sex</label>
                                <select id="sex" name="sex" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('sex')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tribeName">Tribe Name</label>
                                <input type="text" id="tribeName" name="tribeName" class="form-control" value="{{ old('tribeName') }}">
                                @error('tribeName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="pwd">PWD (Yes or No)</label>
                                <select id="pwd" name="pwd" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('pwd')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="arb">ARB (Yes or No)</label>
                                <select id="arb" name="arb" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('arb')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="fourPs">4Ps (Yes or No)</label>
                                <select id="fourPs" name="fourPs" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('fourPs')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>


                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


                <script>
                    function toggleFields() {
                        var farmerType = document.getElementById('farmerType').value;
                        var cropsOrLivestocks = document.getElementById("cropsOrLivestocks").value;

                        // Hide all farmer type sections initially
                        document.getElementById('personalInfo').style.display = 'none';
                        document.getElementById('groupInfo').style.display = 'none';
                        document.getElementById('indigenousInfo').style.display = 'none';

                        // Show sections based on the selected farmer type
                        if (farmerType === 'individual') {
                            document.getElementById('personalInfo').style.display = 'block';
                        } else if (farmerType === 'group') {
                            document.getElementById('groupInfo').style.display = 'block';
                        } else if (farmerType === 'indigenous') {
                            document.getElementById('indigenousInfo').style.display = 'block';
                        }

                        // Hide all the crops or livestock related fields initially
                        document.getElementById('cropsFields').style.display = 'none';
                        document.getElementById('livestocksFields').style.display = 'none';

                        // Show fields based on the selected crops or livestocks
                        if (cropsOrLivestocks === "crops") {
                            document.getElementById('cropsFields').style.display = 'block';
                        } else if (cropsOrLivestocks === "livestocks") {
                            document.getElementById('livestocksFields').style.display = 'block';
                        }
                    }
                </script>




            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('photoPreview');
                preview.style.display = 'block';
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        // Check for success session data and show toast
        @if(session('success'))
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    delay: 5000,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        @endif

        // Initialize DataTable for calamity reports
        $(document).ready(function() {
            $('#calamityReportsTable').DataTable();
        });

        // Function to generate printable report
        function printReport() {
            var table = document.getElementById('calamityReportsTable');
            var newWindow = window.open('', '', 'width=800, height=600');
            newWindow.document.write('<html><head><title>Calamity Reports</title>');
            newWindow.document.write('<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">');
            newWindow.document.write('</head><body>');
            newWindow.document.write(table.outerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

</body>
</html>
