        <div id="CCForm20" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="sub-head"> OOS Extension </div>
                    @if($oosExtension && $oosExtension->oos_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Proposed Due Date (OOS)</label>
                                <div class="calenderauditee">
                                    <input type="text" name="oos_proposed_due_date" id="oos_proposed_due_date" 
                                     value="{{Helpers::getdateFormat($oosExtension->oos_proposed_due_date)}}" disabled />
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Audit Schedule End Date">Proposed Due Date (OOS)</label>
                            <div class="calenderauditee">
                                <input type="text" id="oos_proposed_due_date" placeholder="DD-MMM-YYYY" />
                                <input type="date" name="oos_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'oos_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($oosExtension && $oosExtension->oos_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="oos_extension_justification">Extension Justification (OOS)</label>
                                <textarea name="oos_extension_justification" placeholder="OOS Extension Justification" disabled id="oos_extension_justification" value="{{$oosExtension->dev_extension_justification}}">{{$oosExtension->dev_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="oos_extension_justification">Extension Justification (OOS)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div> -->
                            <textarea class="tiny" name="oos_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    @endif

                    @if($oosExtension && $oosExtension->oos_extension_completed_by)
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" oos_extension_completed_by"> OOS Extension Completed By </label>
                                <select name="oos_extension_completed_by" id="oos_extension_completed_by" disabled>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $oosExtension->oos_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for=" oos_extension_completed_by"> OOS Extension Completed By
                            </label>
                            <select name="oos_extension_completed_by" id="oos_extension_completed_by" >
                                <option value="">-- Select --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if($oosExtension && $oosExtension->oos_extension_completed_on)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">OOS Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="oos_extension_completed_on" readonly 
                                    name="oos_extension_completed_on" placeholder="DD-MMM-YYYY" value="{{Helpers::getdateFormat($oosExtension->oos_extension_completed_on)}}" />
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Audit Schedule End Date">OOS Extension Completed On</label>
                            <div class="calenderauditee">
                                <input type="text" id="oos_extension_completed_on" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="oos_extension_completed_on"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'oos_extension_completed_on')" />
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- CAPA EXTENSION START -->
                    <div class="sub-head">
                        CAPA Extension
                    </div>
                    @if($capaExtension && $capaExtension->capa_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="capa_proposed_due_date" disabled name="capa_proposed_due_date"
                                        placeholder="DD-MMM-YYYY" value="{{Helpers::getdateFormat($capaExtension->capa_proposed_due_date)}}" />
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                            <div class="calenderauditee">
                                <input type="text" id="capa_proposed_due_date" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="capa_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'capa_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($capaExtension && $capaExtension->capa_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="capa_extension_justification" placeholder="Capa Extension Justification" id="capa_extension_justification" disabled>{{$capaExtension->capa_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div> -->
                            <textarea class="tiny" name="capa_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        @if($capaExtension && $capaExtension->capa_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" capa_extension_completed_by"> CAPA Extension Completed By </label>
                                    <select name="capa_extension_completed_by" id="capa_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $capaExtension->capa_extension_completed_by) selected @endif  >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" capa_extension_completed_by"> CAPA Extension Completed By
                                </label>
                                <select name="capa_extension_completed_by" id="capa_extension_completed_by" >
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        @if($capaExtension && $capaExtension->capa_extension_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="capa_extension_completed_on" name="capa_extension_completed_on" disabled placeholder="DD-MMM-YYYY" 
                                         value="{{Helpers::getdateFormat($capaExtension->capa_extension_completed_on)}}" />
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="capa_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date" name="capa_extension_completed_on" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        oninput="handleDateInput(this, 'capa_extension_completed_on')"   class="hide-input"/>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- QRM EXTENSION START -->
                    <div class="sub-head"> Quality Risk Management Extension </div>
                    @if($qrmExtension && $qrmExtension->qrm_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="qrm_proposed_due_date" name="qrm_proposed_due_date" value="{{Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date)}}" disabled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                            <div class="calenderauditee">
                                <input type="text" id="qrm_proposed_due_date" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="qrm_proposed_due_date"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                    oninput="handleDateInput(this, 'qrm_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($qrmExtension && $qrmExtension->qrm_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="qrm_extension_justification">Extension Justification (Quality Risk Management)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea disabled name="qrm_extension_justification" id="qrm_extension_justification" value="{{$qrmExtension->qrm_extension_justification}}">{{$qrmExtension->qrm_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="qrm_extension_justification">Extension Justification (Quality Risk Management)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                            <textarea class="tiny" name="qrm_extension_justification" id="summernote-10"></textarea>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        @if($qrmExtension && $qrmExtension->qrm_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="qrm_extension_completed_by"> Quality Risk Management Extension Completed By </label>
                                    <select name="qrm_extension_completed_by" id="qrm_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $qrmExtension->qrm_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Quality_Risk_Management_Extension_Completed_By"> Quality Risk Management Extension Completed By </label>
                                <select name="qrm_extension_completed_by" id="qrm_extension_completed_by">
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @if($qrmExtension && $qrmExtension->qrm_extension_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="qrm_extension_completed_on">Quality Risk Management Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="qrm_extension_completed_on" name="qrm_extension_completed_on" value="{{Helpers::getdateFormat($qrmExtension->qrm_extension_completed_on)}}" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qrm_extension_completed_on">Quality Risk Management Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="qrm_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date"name="qrm_extension_completed_on"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'qrm_extension_completed_on')"  />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Investigation EXTENSION START -->


                     <!-- Investigation EXTENSION START -->

                    <div class="sub-head">Investigation Extension </div>

                    @if($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="investigation_proposed_due_date" name="investigation_proposed_due_date" 
                                    value="{{Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date)}}" disabled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                            <div class="calenderauditee">
                                <input type="text" id="investigation_proposed_due_date" readonly placeholder="DD-MMM-YYYY"  />
                                <input type="date" name="investigation_proposed_due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                 class="hide-input" oninput="handleDateInput(this, 'investigation_proposed_due_date')"  />
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($investigationExtension && $investigationExtension->investigation_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="investigation_extension_justification">Extension Justification (Investigation)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea disabled name="investigation_extension_justification" placeholder="Investigation Extension Justification" id="investigation_extension_justification" value="{{$investigationExtension->investigation_extension_justification}}">{{$investigationExtension->investigation_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="investigation_extension_justification">Extension Justification (Investigation)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                    not require completion</small></div>
                            <textarea class="tiny" name="investigation_extension_justification" id="summernote-10">
                        </textarea>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        @if($investigationExtension && $investigationExtension->investigation_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" Investigation_Extension_Completed_By"> Investigation Extension Completed By</label>
                                    <select name="investigation_extension_completed_by" id="investigation_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $investigationExtension->investigation_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" investigation_extension_completed_by"> Investigation Extension Completed By </label>
                                <select name="investigation_extension_completed_by"id="investigation_extension_completed_by" >
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        @if($investigationExtension && $investigationExtension->investigation_extension_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="investigation_extension_completed_on">Investigation Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text"  id="investigation_extension_completed_on" name="investigation_extension_completed_on" value="{{Helpers::getdateFormat($investigationExtension->investigation_extension_completed_on)}}" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="investigation_extension_completed_on">Investigation Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="investigation_extension_completed_on" readonly placeholder="DD-MMM-YYYY"  />
                                    <input type="date" name="investigation_extension_completed_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class="hide-input" oninput="handleDateInput(this, 'investigation_extension_completed_on')"  />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                   
                    </div>

                    <div class="button-block">
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit" class="saveButton" {{ $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                        <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <button type="button" class="backButton">Back</button>
                        </a>
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                                {{-- @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif --}}
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                    </div>
                </div>
            </div>
        </div>