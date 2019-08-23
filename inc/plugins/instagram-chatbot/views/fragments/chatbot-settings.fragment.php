<div class="section-content">
    <div class="form-result mb-25"></div>

    <div class="clearfix">

        <div class="clearfix mb-40">
            <!-- <div class="col s6 m6 l6">
<label class="form-label">Speed</label>

<select class="input" name="speed">
<option value="auto">Not Ready yet</option>

</select>
</div> -->

            <div class="col s6 s-last m6 m-last l6 l-last">
                <label class="form-label">Status</label>

                <select class="input" id="chatbot_status_select" name="is_active">
                    <?php if ($Settings->chatbot_status) { ?>
                    <option value="0">Deactive</option>
                    <option value="1" selected="">Active</option>
                    <?php } else { ?>
                    <option value="0" selected="">Deactive</option>
                    <option value="1">Active</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="clearfix">
            <div class="col s12 m6 l6">
                <button class="fluid button chatbot_status" id="<?= APPURL ?>/chatbot/settings/<?= $Account->get("id"); ?>">Save</button>
            </div>
        </div>
    </div>
    <div class="clearfix mb-40">
        <div class="stats-box">
            <div class="stats-head">
                <h3><span>Error</span> Log</h3>

            </div>
            <table class="tb-stats">
                <tbody>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><strong>Action</strong></td>
                        <td><strong>Error</strong></td>
                    </tr>
                    <?php if ($ErrorLog) : ?>
                    <?php foreach ($ErrorLog as $error) : ?>
                    <tr>
                        <td data-label="Date"><?= $error->date ?></td>
                        <td data-label="Action">
                            <?= $error->error_action ?>
                        </td>
                        <td data-label="Error">
                            <?= $error->error_message ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
