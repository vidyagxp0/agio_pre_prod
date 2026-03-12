@php
    $mainmenu = 'User Management';
    $submenu = 'Login Account';

@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Account </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user_management.store') }}" method="POST">
            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name <span style="color: red">*</span></label>
                    <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter User Name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Code<span style="color: red">*</span></label>
                    <input type="name" name="emp_code" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Employee Code" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email <span style="color: red">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password <span style="color: red">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="departmentid">Department Name <span style="color: red">*</span></label>
                    <select class="form-control @error('departmentid') is-invalid @enderror" id="departmentid" name="departmentid" required>
                        @foreach ($department as $temp)
                            <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                        @endforeach
                    </select>
                    @error('departmentid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="form-group" id="roleGroup">
                    <label for="roles">Roles (Ctrl (windows) or Command (Mac) button to select multiple options)<span style="color: red">*</span></label>
                    <select class="form-control2 @error('roles') is-invalid @enderror" id="roles" name="roles[]" multiple required onchange="updateSelectedOptions()">
                        @foreach ($group as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div id="selectedOptions"></div>

                <script>
                    function updateSelectedOptions() {
                        var selectElement = document.getElementById("roles");
                        var selectedOptions = [];
                        for (var i = 0; i < selectElement.options.length; i++) {
                            if (selectElement.options[i].selected) {
                                selectedOptions.push(selectElement.options[i].text);
                            }
                        }
                        document.getElementById("selectedOptions").innerHTML = "Selected roles: <br>" + selectedOptions.join("<br>");
                    }
                </script> --}}
                {{-- <div class="form-group" id="roleGroup">
                    <label for="roles">
                        Roles (Click to select multiple options)<span style="color: red">*</span>
                    </label>
                    <select class="form-control2 @error('roles') is-invalid @enderror"
                            id="roles" name="roles[]" multiple required>
                        @foreach ($group as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="selectedOptions"></div>

                <script>
                    const selectElement = document.getElementById("roles");

                    for (let i = 0; i < selectElement.options.length; i++) {
                        selectElement.options[i].addEventListener("mousedown", function (e) {
                            e.preventDefault();
                            this.selected = !this.selected;
                            updateSelectedOptions();
                        });
                    }

                    function updateSelectedOptions() {
                        let selectedOptions = [];
                        for (let i = 0; i < selectElement.options.length; i++) {
                            if (selectElement.options[i].selected) {
                                selectedOptions.push(selectElement.options[i].text);
                            }
                        }
                        document.getElementById("selectedOptions").innerHTML =
                            "Selected roles: <br>" + selectedOptions.join("<br>");
                    }
                </script> --}}

                <div class="form-group" id="roleGroup">
                    <label for="roles">
                        Roles (Click to select multiple options)<span style="color: red">*</span>
                    </label>

                    <!-- Search Input with Clear Button -->
                    <div style="margin-bottom: 10px; position: relative;">
                        <input type="text"
                            id="roleSearch"
                            class="form-control"
                            placeholder="Search roles..."
                            style="padding: 8px 30px 8px 8px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                        <span id="clearSearch"
                            style="position: absolute; right: 10px; top: 8px; cursor: pointer; color: #999; display: none;">✕</span>
                    </div>

                    <select class="form-control2 @error('roles') is-invalid @enderror"
                            id="roles"
                            name="roles[]"
                            multiple
                            required
                            style="height: 200px; width: 100%;">
                        @foreach ($group as $role)
                            <option value="{{ $role->id }}" data-name="{{ strtolower($role->name) }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('roles')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div style="margin-top: 5px; margin-bottom: 10px;">
                    <button type="button" id="selectAllVisible"
                            style="padding: 5px 15px; background-color: #f0f0f0; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; font-size: 14px;">
                        Select All Visible
                    </button>
                </div>

                <div id="selectedOptions"></div>

                <script>
                    // Wait for DOM to be fully loaded
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectElement = document.getElementById("roles");
                        const searchInput = document.getElementById("roleSearch");
                        const clearBtn = document.getElementById("clearSearch");
                        const selectAllBtn = document.getElementById("selectAllVisible");

                        if (!selectElement || !searchInput || !clearBtn || !selectAllBtn) {
                            console.error('Required elements not found');
                            return;
                        }

                        // Variable to store scroll position
                        let scrollPosition = 0;

                        // Save scroll position before any operation
                        function saveScrollPosition() {
                            scrollPosition = selectElement.scrollTop;
                        }

                        // Restore scroll position after operation
                        function restoreScrollPosition() {
                            setTimeout(() => {
                                selectElement.scrollTop = scrollPosition;
                            }, 0);
                        }

                        // Search functionality
                        searchInput.addEventListener("keyup", function() {
                            saveScrollPosition();
                            const searchTerm = this.value.toLowerCase().trim();

                            // Show/hide clear button
                            clearBtn.style.display = searchTerm ? 'block' : 'none';

                            for (let i = 0; i < selectElement.options.length; i++) {
                                const option = selectElement.options[i];
                                const roleName = option.text.toLowerCase();

                                if (searchTerm === '' || roleName.includes(searchTerm)) {
                                    option.style.display = 'block';
                                } else {
                                    option.style.display = 'none';
                                }
                            }

                            // Update select all button text based on visible options
                            updateSelectAllButtonText();
                            restoreScrollPosition();
                        });

                        // Clear search
                        clearBtn.addEventListener("click", function() {
                            saveScrollPosition();
                            searchInput.value = '';
                            clearBtn.style.display = 'none';

                            // Show all options
                            for (let i = 0; i < selectElement.options.length; i++) {
                                selectElement.options[i].style.display = 'block';
                            }

                            searchInput.focus();
                            updateSelectAllButtonText();
                            restoreScrollPosition();
                        });

                        // Select All Visible button functionality
                        selectAllBtn.addEventListener('click', function() {
                            saveScrollPosition();
                            toggleVisibleOptions();
                            restoreScrollPosition();
                        });

                        // FIXED: Toggle selection on click without losing scroll position
                        for (let i = 0; i < selectElement.options.length; i++) {
                            selectElement.options[i].addEventListener("mousedown", function (e) {
                                e.preventDefault(); // Stop default behavior

                                // Save current scroll position
                                const currentScrollTop = selectElement.scrollTop;

                                // Toggle selection
                                this.selected = !this.selected;

                                // Trigger change event to update displays
                                updateSelectedOptions();
                                updateSelectAllButtonText();

                                // Force scroll position to remain the same
                                selectElement.scrollTop = currentScrollTop;
                            });
                        }

                        // Handle Ctrl + A (select/deselect all visible)
                        selectElement.addEventListener("keydown", function (e) {
                            if (e.ctrlKey && e.key === "a") {
                                e.preventDefault();
                                saveScrollPosition();
                                toggleVisibleOptions();
                                restoreScrollPosition();
                            }
                        });

                        // Handle Ctrl + F for search focus
                        document.addEventListener('keydown', function(e) {
                            if (e.ctrlKey && e.key === 'f') {
                                e.preventDefault();
                                searchInput.focus();
                            }
                        });

                        // Handle option click via keyboard (space bar)
                        selectElement.addEventListener("keydown", function(e) {
                            if (e.key === " " && e.target.tagName === "OPTION") {
                                e.preventDefault();
                                const option = e.target;

                                // Save current scroll position
                                const currentScrollTop = selectElement.scrollTop;

                                // Toggle selection
                                option.selected = !option.selected;

                                // Update displays
                                updateSelectedOptions();
                                updateSelectAllButtonText();

                                // Restore scroll position
                                selectElement.scrollTop = currentScrollTop;
                            }
                        });

                        // Function to toggle all visible options
                        function toggleVisibleOptions() {
                            const visibleOptions = Array.from(selectElement.options)
                                .filter(opt => opt.style.display !== 'none');

                            if (visibleOptions.length > 0) {
                                const allVisibleSelected = visibleOptions.every(opt => opt.selected);

                                visibleOptions.forEach(opt => {
                                    opt.selected = !allVisibleSelected;
                                });

                                updateSelectedOptions();
                                updateSelectAllButtonText();
                            }
                        }

                        // Update select all button text
                        function updateSelectAllButtonText() {
                            const visibleOptions = Array.from(selectElement.options)
                                .filter(opt => opt.style.display !== 'none');

                            if (visibleOptions.length > 0) {
                                const allVisibleSelected = visibleOptions.every(opt => opt.selected);
                                selectAllBtn.textContent = allVisibleSelected ? 'Deselect All Visible' : 'Select All Visible';
                            } else {
                                selectAllBtn.textContent = 'Select All Visible';
                            }
                        }

                        // Update selected options display
                        function updateSelectedOptions() {
                            let selectedOptions = [];
                            for (let i = 0; i < selectElement.options.length; i++) {
                                if (selectElement.options[i].selected) {
                                    selectedOptions.push(selectElement.options[i].text);
                                }
                            }

                            const container = document.getElementById("selectedOptions");
                            if (selectedOptions.length > 0) {
                                let html = '<strong>Selected roles (' + selectedOptions.length + '):</strong><br>';
                                html += selectedOptions.map(role => '• ' + role).join('<br>');
                                container.innerHTML = html;
                            } else {
                                container.innerHTML = '<em>No roles selected</em>';
                            }
                        }

                        // Initial updates
                        updateSelectedOptions();
                        updateSelectAllButtonText();
                    });
                </script>

                <style>
                    #roles option {
                        padding: 8px 12px;
                        cursor: pointer;
                        transition: background-color 0.2s;
                    }

                    #roles option:hover {
                        background-color: #e8f0fe;
                    }

                    #roles option:checked {
                        background-color: #d4e3fd;
                        font-weight: 500;
                        position: relative;
                    }

                    #roles option:checked::before {
                        content: "✓ ";
                        color: #0d6efd;
                        font-weight: bold;
                    }

                    #selectAllVisible {
                        transition: all 0.2s;
                    }

                    #selectAllVisible:hover {
                        background-color: #e0e0e0;
                    }

                    #clearSearch:hover {
                        color: #333 !important;
                    }

                    .form-control2.is-invalid {
                        border-color: #dc3545;
                    }

                    .invalid-feedback {
                        display: block;
                        color: #dc3545;
                        font-size: 80%;
                        margin-top: 5px;
                    }

                    /* Ensure select doesn't lose focus styles */
                    #roles:focus {
                        outline: none;
                        border-color: #80bdff;
                        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
                    }
                </style>


            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <style>
            .form-control2 {
                width: 100%;
                height: 200px;
                font-size: 14px;
                line-height: 0.5;
                border-radius: 5px;
                padding: 15px 25px;
                border: 1px solid rgba(0, 0, 0, 0.1);
             }
             body:not(.layout-fixed) .main-sidebar {
                height: inherit;
                min-height: 100%;
                position: fixed;
                top: 0;
            }
        </style>
    </div>
    <!-- /.card -->
@endsection
