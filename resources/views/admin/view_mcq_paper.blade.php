<!-- Main Header -->
@include('admin.layouts.header')
  <!-- Sidebar -->
  @include('admin.layouts.sidebar')
<!-- [ Main Content ] start -->
<!-- <link rel="stylesheet" href="{{ asset('public/assets/css/summernote-bs4.css')}}"> -->
<link href="{{ asset('public/assets/summernote/summernote-bs4.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/assets/summernote/summernote.css')}}" rel="stylesheet">
<section class="pcoded-main-container">
<div class="pcoded-content">
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{ $paper_stack->question_paper->subject_name }} MCQ Paper</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item active">{{ $paper_stack->question_paper->subject_name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ stiped-table ] start -->
<div class="col-xl-12">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="content" style="width:100%;max-width: 950px; margin: auto;">
                <div id="download-btn" style="text-align: right;font-weight: bold; color: #20307b;"><a href="javascript:void(0);" onclick="window.print();" >Download Paper</a></div>
                <table style="width: 100%; border:2px solid #000;margin-bottom: 16px" cellspacing="0">
                    <tbody>
                        <tr>
                            <td rowspan="4" style="width: 17%; border-right:2px solid #000;">
                                <img src="{{ url('/') }}/uploads/{{ $logo_file }}" style="width: 100%; vertical-align: middle;" id="left_logo">
                            </td>
                            <td rowspan="3" style="text-align: center; width: 50%">
                                <h4 style="margin:0px; font-size: 35px; text-transform: uppercase;"><?= $title ?></h4>
                                <h5 style="margin:0px; font-size: 18px;"><?= $paper_stack->question_paper->class_name ?> (<?= $paper_stack->question_paper->medium;?>)</h5>
                                <label></label>
                                <h4 style="margin:0px; font-size: 20px;background-color: #000; padding: 3px; color: #fff;"><?= strtoupper($paper_stack->question_paper->subject_name) ?></h4>
                            </td>
                            <td style="width: 15%; border-left:2px solid #000; border-bottom:2px solid #000;">DATE: <?= date("d-m-Y", strtotime($paper_stack->question_paper->created_at)) ?></td>
                        </tr>
                        <tr><?php
                            if(!empty($paper_stack->questions)) {
                                if(count($paper_stack->questions) <= 20){
                                    $time = "1 Hour";
                                } elseif(count($paper_stack->questions) > 20 && count($paper_stack->questions) <= 30) {
                                    $time = "1.5 Hour";
                                } elseif(count($paper_stack->questions) > 30 && count($paper_stack->questions) <= 40){
                                    $time = "2 Hour";
                                } elseif(count($paper_stack->questions) > 40 && count($paper_stack->questions) <= 80) {
                                    $time = "2.5 Hour";
                                } elseif(count($paper_stack->questions) > 80 && count($paper_stack->questions) <= 100) {
                                    $time = "3 Hour";
                                }
                            } else {
                                $time = "";
                            } ?>
                            <td style=" border-left:2px solid #000; border-bottom:2px solid #000;">TIME: <?= $time ?></td>
                        </tr>
                        <tr>
                            <td style="border-left:2px solid #000; border-bottom:2px solid #000;">MARKS: <?= count($paper_stack->questions) ?></td>
                        </tr>
                        <tr>
                            <td><span style="float: right; font-weight:bold;">SEAT NO:</span></td>
                            <td>
                                <table width="100%" cellspacing="0" border="1">
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                            <td style="border:1px solid #000;">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered mt-3">
                    <tbody><?php 
                        $k=1; 
                        foreach ($paper_stack->questions as $key => $onequestion){ ?>                        
                            <tr>
                                <td width="5"><b>Q.<?php echo $k.'. '; ?></b></td>
                                <td class="line-me" style='width: 100% !important;'><?= trim($onequestion->question) ?></td>
                            </tr><?php
                            if (!empty($paper_stack->options)){
                                foreach ($paper_stack->options as $one_options){
                                    if($one_options->question_id == $onequestion->question_id){ ?>
                                        <tr>
                                            <td width="5"></td>
                                            <td class="line-me" style='width: 100% !important;'><?= $one_options->option_detail;?></td>
                                        </tr><?php
                                    }
                                } 
                            }
                            $k++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- [ stiped-table ] end -->
<!-- Footer -->
@include('admin.layouts.footer')
</body>
</html>