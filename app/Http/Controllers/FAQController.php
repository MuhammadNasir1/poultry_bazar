<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // delete faqs
    public function deleteFAQ(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'faq_id' => 'required',
            ]);

            $FAQs = FAQ::where('faq_id', $validatedData['faq_id'])->first();

            $FAQs->delete();

            return response()->json(['success' => true, 'message' => 'FAQ deleted successfully'], 200);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // delete faqs

    // add faqs
    public function addFAQs(Request $request)
    {
        try {
            $faqId = $request->input('faq_id');

            $user = session('user_details');

            $validatedData = $request->validate([
                'faq_question' => 'required',
                'faq_answer' => 'required',
            ]);

            if ($faqId != null) {
                $FAQs = FAQ::where('faq_id', $faqId)->first();

                $FAQs->faq_question = $validatedData['faq_question'];
                $FAQs->faq_answer = $validatedData['faq_answer'];
                $FAQs->save();

                return response()->json(['success' => true, 'message' => 'FAQ updated successfully'], 200);
            }else{
                $FAQs = FAQ::create([
                    'added_user_id' => $user['id'],
                    'faq_question' => $validatedData['faq_question'],
                    'faq_answer' => $validatedData['faq_answer'],
                ]);

                return response()->json(['success' => true, 'message' => 'FAQ added successfully'], 200);
            }   

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add faqs

    // get faqs
    public function getFAQs()
    {
        $user = session('user_details');

        $FAQs = FAQ::where('added_user_id', $user['id'])->get();
        return view('faqs', ['faqs' => $FAQs]);
    }
    // get faqs
}
