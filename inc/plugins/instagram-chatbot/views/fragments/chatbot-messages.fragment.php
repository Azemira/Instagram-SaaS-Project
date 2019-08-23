<div class="section-content">

    <input type="hidden" name="action" value="save">

    <div class="section-header clearfix">

        <div class="clearfix">
            <div class="col s12 m12 l8 pt-15">
                <i class="mdi mdi-settings"></i>
                <h2 class="section-title logged-user-account" id="<?= $Account->get("id"); ?>"><?= htmlchars($Account->get("username")) ?></h2>
            </div>
            <div class="col s12 m6 l4 l-last">
                <a id="myBtn" href="javascript:void(0)" class="fluid button button--light-outline js-add-new-comment-btn">
                    <span class="mdi mdi-plus-circle"></span>
                    <?= __("Add New Message") ?>
                </a>

            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="form-result"></div>

        <div class="clearfix">
            <div class="col s12 messages-list-content">
                <?php if ($ChatbotMessages->getTotalCount() > 0) : ?>
                <?php foreach ($ChatbotMessages->getDataAs("Caption") as $key => $message) : ?>
                <div class="pt-25 pb-25 pl-10 pr-10 mb-20 chatbot-messages-list" data-order-id="<?= $key ?>" data-id="<?= $message->get("id"); ?>" id="message-main-<?= $message->get("id"); ?>" style="background-color: #F8F8F8">
                    <div class="messages-order-up">
                        <?php if ($key !== 0) : ?>
                        <a href="javascript:void(0)" class="message-sent-up" id="<?= $message->get("id"); ?>"><?= __("up") ?></a>
                        <?php endif ?>
                    </div>
                    <div class="mb-20 mt-10">
                        <label class="form-label chatbot-form-label"><?= $key ?> </label>

                        <div class="clearfix">
                            <div class="col s12 m12 l10 mb-20">
                                <div class="new-comment-input input meessageedit" id="message-<?= $message->get("id"); ?>-editor" data-placeholder="<?= __("Edit") ?>" contenteditable="false"><?= json_decode('"' . $message->get("message") . '"'); ?></div>
                            </div>

                            <div class="col s12 m12 l2 l-last">
                                <a href="javascript:void(0)" id="<?= $message->get("id"); ?>" style="background-color:#D45F5F !important; color:white;" class="chatbot-message-delete fluid button button--light-outline mb-15 js-add-new-comment-btn">
                                    <?= __("Delete") ?>
                                </a>
                                <a href="javascript:void(0)" id="message-<?= $message->get("id"); ?>" class="chatbot-message-item fluid button button--light-outline mb-15 js-add-new-comment-btn">
                                    <?= __("Edit") ?>
                                </a>
                                <a href="javascript:void(0)" hidden class="chatbot-button message-update-submit" id="<?= $message->get("id"); ?>">Save</a>
                            </div>
                        </div>
                    </div>

                    <ul class="field-tips">
                        <li>
                            <?= __("You can use following variables in the comments:") ?>

                            <div class="mt-5">
                                <strong>{{username}}</strong>
                                <?= __("Media owner's username") ?>
                            </div>

                            <div class="mt-5">
                                <strong>{{full_name}}</strong>
                                <?= __("Media owner's full name. If user's full name is not set, username will be used.") ?>
                            </div>
                        </li>
                    </ul>
                    <?php $messages = $ChatbotMessages->getDataAs("Caption") ?>

                    <div class="messages-order-down">
                        <?php if ($key + 1 !== sizeOf($messages)) : ?>
                        <a href="javascript:void(0)" class="message-sent-down" id="<?= $message->get("id"); ?>"><?= __("down") ?></a>
                        <?php endif ?>
                    </div>

                </div>
                <?php endforeach; ?>
                <?php else : ?>

                <div class="clearfix">
                    <div class="col s12 m12 l12 mb-20">
                        This User Has no Messages
                    </div>
                </div>

                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="Modal is-hidden is-visuallyHidden">
    <!-- Modal content -->
    <form class="js-chatbot-message-form" action="<?= APPURL . "/chatbot/message/new/" . $Account->get("id"); ?>" method="POST">

        <input type="hidden" name="action" value="save">
        <div class="Modal-content">
            <span id="closeModal" class="Close">&times;</span>
            <div class="mb-10">
                <label class="form-label"><?= __("Message") ?></label>

                <div class="clearfix content-area">
                    <div class="col s12 m12 l12 pt-25 modal-input">
                        <div class="new-comment-input input meessageinput" data-placeholder="<?= __("Edit") ?>" contenteditable="true"></div>
                    </div>

                    <div class="col s12 m12 l12 l-last pt-10 modal-buttons">
                        <div class="col s4 ">

                        </div>
                        <div class="col s4 ">
                            <a id="modal-cancel" href="javascript:void(0)" class="fluid button button--light-outline js-add-new-comment-btn">
                                <?= __("Cancel") ?>
                            </a>
                        </div>
                        <div class="col s4">

                            <input class="fluid button submit-buttom" type="submit" value="<?= __("Save") ?>">

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
