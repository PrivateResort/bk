<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of section.
     * http://localhost:8000/api/sections
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => Section::all()
        ],200);
     }

     /**
      * Create section
      * http://localhost:8000/api/sections/
      */

      public function create(Request $request){
        $validator = validator($request->all(), [
            'section_name' => 'required | max:30',
            'section_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Section Creation Failed',
                'errors' => $validator->errors()
            ], 400);
        }
            
        $section = Section::create($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Section Created Successfully',
            'data' => $section
        ], 200);
      }

      /**
       * Update section
       * http://localhost:8000/api/sections/{section}
       */

       public function update(Request $request, Section $section){
        $validator = validator($request->all(), [
            'section_name' => 'required | max:30',
            'section_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Section Update Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $section->update($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Section Updated Successfully',
            'data' => $section
        ], 200);
       }

       /**
        * Show specific section
        * http://localhost:8000/api/sections/{section}
        */

        public function show(Section $section){
           return response()->json([
               'ok' => true,
               'message' => 'Retrieved Successfully',
               'data' => $section
           ], 200);
        }

        /**
         * Delete section
         * http://localhost:8000/api/sections/{section}
         */

         public function destroy(Section $section){
            $section->delete();
            return response()->json([
                'ok' => true,
                'message' => 'Section Deleted Successfully',
                'data' => $section
            ], 200);
         }
}
