<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0f2f5;
            color: #495057;
        }
        .container-fluid {
            margin-top: 20px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            background-color: #003d00; /* Vert très foncé */
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card-body {
            background-color: #ffffff;
            padding: 20px;
        }
        .form-control, .custom-select {
            border-radius: 8px;
        }
        .preview {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #003d00; /* Vert très foncé */
            color: white;
        }
        .btn-add {
            background-color: #003d00; /* Vert très foncé */
            color: white;
            border-radius: 8px;
        }
        .btn-add:hover {
            background-color: #002a00; /* Vert encore plus foncé pour le survol */
        }
        .btn-remove {
            color: #dc3545;
        }
        .btn-remove:hover {
            color: #c82333;
        }
        .callout {
            border: 1px solid #d3d6d9;
            border-radius: 8px;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .callout-info {
            border-color: #17a2b8;
        }
        .callout-info h4 {
            margin-top: 0;
            color: #17a2b8;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Manage Question
            </div>
            <div class="card-body">
                <form action="" id="manage-question">
                    <div class="row">
                        <!-- Colonne pour les détails de la question -->
                        <div class="col-lg-6">
                            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                            <input type="hidden" name="sid" value="<?php echo isset($_GET['sid']) ? $_GET['sid'] : ''; ?>">
                            
                            <!-- Champ pour saisir la question -->
                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <textarea name="question" id="question" rows="4" class="form-control"><?php echo isset($question) ? $question : ''; ?></textarea>
                            </div>
                            
                            <!-- Sélecteur pour choisir le type de réponse -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Question Answer Type</label>
                                <select name="type" id="type" class="form-select form-select-sm">
                                    <?php if (isset($id)): ?>
                                    <option value="" disabled="" selected="">Please Select here</option>
                                    <?php endif; ?>
                                    <option value="radio_opt" <?php echo isset($type) && $type == 'radio_opt' ? 'selected' : ''; ?>>Single Answer/Radio Button</option>
                                    <option value="check_opt" <?php echo isset($type) && $type == 'check_opt' ? 'selected' : ''; ?>>Multiple Answer/Check Boxes</option>
                                    <option value="textfield_s" <?php echo isset($type) && $type == 'textfield_s' ? 'selected' : ''; ?>>Text Field/ Text Area</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Colonne pour l'aperçu -->
                        <div class="col-lg-6">
                            <b>Preview</b>
                            <div class="preview">
                                <?php if (!isset($id)): ?>
                                <center><b>Select Question Answer type first.</b></center>
                                <?php else: ?>
                                    <div class="callout callout-info">
                                        <?php if ($type != 'textfield_s'): 
                                            $opt = $type == 'radio_opt' ? 'radio' : 'checkbox';
                                        ?>
                                        <table class="table">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="80%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="text-center"></th>
                                                    <th class="text-center">Label</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                                                $i = 0;
                                                foreach (json_decode($frm_option) as $k => $v):
                                                    $i++;
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="icheck-primary d-inline" data-count='<?php echo $i ?>'>
                                                            <input type="<?php echo $opt ?>" id="<?php echo $opt ?>Primary<?php echo $i ?>" name="<?php echo $opt ?>" checked="">
                                                            <label for="<?php echo $opt ?>Primary<?php echo $i ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm" name="label[]" value="<?php echo $v ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" class="btn-remove" onclick="$(this).closest('tr').remove()"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="text-center mt-3">
                                            <button class="btn btn-add btn-sm" type="button" onclick="<?php echo $type ?>($(this))"><i class="fa fa-plus"></i> Add</button>
                                        </div>
                                        <?php else: ?>
                                            <textarea name="frm_opt" id="" cols="30" rows="10" class="form-control" disabled="" placeholder="Write Something here..."></textarea>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modèles cachés pour les options -->
    <div id="check_opt_clone" style="display: none">
        <div class="callout callout-info">
            <table class="table">
                <colgroup>
                    <col width="10%">
                    <col width="80%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Label</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <div class="icheck-primary d-inline" data-count='1'>
                                <input type="checkbox" id="checkboxPrimary1" checked="">
                                <label for="checkboxPrimary1"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control form-control-sm check_inp" name="label[]">
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div class="icheck-primary d-inline" data-count='2'>
                                <input type="checkbox" id="checkboxPrimary2">
                                <label for="checkboxPrimary2"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control form-control-sm check_inp" name="label[]">
                        </td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <button class="btn btn-add btn-sm" type="button" onclick="new_check($(this))"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </div>

    <div id="radio_opt_clone" style="display: none">
        <div class="callout callout-info">
            <table class="table">
                <colgroup>
                    <col width="10%">
                    <col width="80%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Label</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <div class="icheck-primary d-inline" data-count='1'>
                                <input type="radio" id="radioPrimary1" name="radio" checked="">
                                <label for="radioPrimary1"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control form-control-sm check_inp" name="label[]">
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div class="icheck-primary d-inline" data-count='2'>
                                <input type="radio" id="radioPrimary2" name="radio">
                                <label for="radioPrimary2"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control form-control-sm check_inp" name="label[]">
                        </td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <button class="btn btn-add btn-sm" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </div>

    <div id="textfield_s_clone" style="display: none">
        <div class="callout callout-info">
            <textarea name="frm_opt" id="" cols="30" rows="10" class="form-control" disabled="" placeholder="Write Something here..."></textarea>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function new_check(_this) {
            var tbody = _this.closest('.row').siblings('table').find('tbody');
            var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count');
            count++;
            var opt = '';
            opt += '<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count="' + count + '"><input type="checkbox" id="checkboxPrimary' + count + '"><label for="checkboxPrimary' + count + '"> </label></div></td>';
            opt += '<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="label[]"></td>';
            opt += '<td class="text-center"><a href="javascript:void(0)" class="btn-remove" onclick="$(this).closest(\'tr\').remove()"><i class="fa fa-times"></i></a></td>';
            var tr = $('<tr></tr>');
            tr.append(opt);
            tbody.append(tr);
        }

        function new_radio(_this) {
            var tbody = _this.closest('.row').siblings('table').find('tbody');
            var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count');
            count++;
            var opt = '';
            opt += '<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count="' + count + '"><input type="radio" id="radioPrimary' + count + '" name="radio"><label for="radioPrimary' + count + '"> </label></div></td>';
            opt += '<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="label[]"></td>';
            opt += '<td class="text-center"><a href="javascript:void(0)" class="btn-remove" onclick="$(this).closest(\'tr\').remove()"><i class="fa fa-times"></i></a></td>';
            var tr = $('<tr></tr>');
            tr.append(opt);
            tbody.append(tr);
        }

        function check_opt() {
            var check_opt_clone = $('#check_opt_clone').clone();
            $('.preview').html(check_opt_clone.html());
        }

        function radio_opt() {
            var radio_opt_clone = $('#radio_opt_clone').clone();
            $('.preview').html(radio_opt_clone.html());
        }

        function textfield_s() {
            var textfield_s_clone = $('#textfield_s_clone').clone();
            $('.preview').html(textfield_s_clone.html());
        }

        $('[name="type"]').change(function() {
            window[$(this).val()]();
        });

        $(function() {
            $('#manage-question').submit(function(e) {
                e.preventDefault();
                start_load();
                $.ajax({
                    url: 'ajax.php?action=save_question',
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    success: function(resp) {
                        if (resp == 1) {
                            alert_toast('Data successfully saved.', "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
