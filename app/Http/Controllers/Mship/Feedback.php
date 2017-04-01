<?php

namespace App\Http\Controllers\Mship;

use Redirect;
use Validator;
use Illuminate\Http\Request;
use App\Models\Mship\Feedback\Question;
use App\Models\Mship\Feedback\Answer;
use App\Models\Mship\Account;

class Feedback extends \App\Http\Controllers\BaseController
{
    public function getFeedback(){
      $questions = Question::orderBy('sequence')->get();
      if(!$questions){
        // We have no questions to display!
        return Redirect::route('mship.manage.dashboard');
      }
      return view('mship.feedback.form', ['questions' => $questions]);
    }

    public function postFeedback(Request $request){
      $questions = Question::all();
      $cidfield = null;
      // Make the validation rules
      $ruleset = [];
      $errormessages = [];
      $answerdata = [];

      foreach ($questions as $question) {
        $rules = [];
        if($question->required){
          $rules[] = "required";
          $errormessages[$question->slug . '.required'] = "Looks like you have not supplied an answer for '" . $question->question . "'.";
        }
        if($question->type == "datetime"){
          $rules[] = "date";
          $errormessages[$question->slug . '.date'] = "Looks like your answer to '" . $question->question . "' wasn't answered correctly. Please try again.";
        }
        if($question->type == "userlookup"){
          $rules[] = "exists:mship_account,id";
          $rules[] = "integer";
          $cidfield = $question->slug;
          $errormessages[$question->slug . '.exists'] = "This user was not found. Please ensure that you have entered the CID correctly.";
          $errormessages[$question->slug . '.integer'] = "You have not entered in a valid CID.";
        }
        if(count($rules > 0)) {
          $ruleset[$question->slug] = join($rules, "|");
        }

        // Add the answer to the array, ready for inserting
        $answerdata[] = new Answer(['question_id' => $question->id, 'response' => $request->input($question->slug)]);
      }

      $validator = Validator::make($request->all(), $ruleset, $errormessages);
      if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();

      }

      if(!$cidfield){
        // No one specified a user lookup field!
        return Redirect::route('mship.manage.dashboard')
                ->withError("Sorry, we can't process your feedback at the moment. Please check back later.");
      }

      // Make new feedback
      $account = Account::find($request->input($cidfield));
      $feedback = $account->feedback()->create([
          'submitter_account_id' => \Auth::user()->id,
      ]);

      // Add in the answers
      $feedback->answers()->saveMany($answerdata);

      return Redirect::route('mship.manage.dashboard')
              ->withSuccess("Your feedback has been recorded. Thank you!");
    }

}
