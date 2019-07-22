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
                                        <option value="0" >Deactive</option>
                                        <option value="1" selected="">Active</option>
                                    <?php } else {?>
                                        <option value="0"  selected="">Deactive</option>
                                        <option value="1">Active</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="col s12 m6 l6">
                                    <button class="fluid button chatbot_status" id="/chatbot/settings/<?= $Account->get("id"); ?>" >Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>