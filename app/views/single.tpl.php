<?php include 'inc/header.php' ?>
<div class="container col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="row">
        <div class="content ">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#quiz">Quiz</a></li>
                <li><a data-toggle="tab" href="#settings">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div id="quiz" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if ($_SESSION[Session::answeredQuestionsCount_key] > 0): ?>
                                <p>Answer to previous question was: <?= AnswerCheck::getPreviousCorrectAnswer()->getTitle() ?></p>
                            <?php endif; ?>
                            <h4>Who said it?</h4>
                        </div>
                        <div class="panel-body">
                            <div class="question-box">
                                "<?= $data['question']->getTitle() ?>"
                            </div>
                            <div class="answer-box">
                                <?= $data['answer']->getTitle(); ?>
                                <form action="?path=answer-check-tf" method="POST">
                                    <input type="hidden" name="question" value="<?= $data['question']->getId() ?>" />
                                    <input type="hidden" name="answer" value="<?= $data['answer']->getId() ?>" />

                                    <button class="tf-btn btn btn-success" type="submit" name="answer_input" value="yes">Yes</button>
                                    <button class="tf-btn btn btn-danger" type="submit" name="answer_input" value="no">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "inc/settings.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>