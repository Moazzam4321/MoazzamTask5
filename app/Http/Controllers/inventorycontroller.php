<?php

namespace App\Http\Controllers;

use App\Models\Inventorysystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class inventorycontroller extends Controller
{
      // Method for insert new inventory data in data
    public function createInventory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:255|regex:/^[\pL\s]+$/',
            'price' => 'bail|required|numeric|max:256',
            'quantity' => 'bail|required|numeric|max:255',
            'category' => 'bail|required|max:255|alpha_num',
        ]);
           // Check validation failure
        if ($validator->fails()) 
        {
          foreach($validator->messages()->getMessages() as $field_name => $errors) 
           {
                    // Go through each message for this field.
                    foreach($errors AS $message) 
                    {
                        return response()->json( '***********'.$message.'***********<br>');
                    }
            }
        }
        // if  validation successful complete
        else 
        {
                // get instance of model
            $inventory=new Inventorysystem();
                // add input values to model instance
            $inventory->name=$request->input('name');
            $inventory->price=$request->input('price');
            $inventory->quantity=$request->input('quantity');
            $inventory->category=$request->input('category');
               // save input into database
            $inventory->save();
               //show output if added successfully
            return response()->json($inventory);
        }
    }
        //Method for read inventory data against it id from database
    public function showInventory($id)
    {
          // get matching inventory id data
        $getInventory= inventorysystem::find($id);
          // check inventory find or not
        if($getInventory)
        {
              // Show inventory data 
            return response()->json($getInventory);
        }
        // if id not match then show all inventory data
        else
        {
               //get all inventory data
             $flights= inventorysystem::all();
             return response()->json($flights);
        }
    }
       // Method for delete inventory data against matching id
    public function destoryInventory($id)
    {
         $data= inventorysystem::find($id);
          // check inventory data against id
         if($data)
            {
                 $data->delete();
                 return response()->json($data);
            }
    }
       //  Method for updating inventory data
    public function updateInventory(Request $request,$id)
    {
         // match the inventory id with input id for updating data
          $DATA = Inventorysystem::firstOrCreate(['id' => $id]); 
            // check name field
          if($request->input('name') != "")
            {
                  // Validate name field
                 $validator = Validator::make($request->all(), [
                 'name' => 'bail|required|regex:/^[\pL\s]+$/|max:255',
                 ]);
                  // Check validation failure
                 if ($validator->fails()) 
                   {
                         $messege=$validator->messages()->getMessageBag();
                          return response()->json($messege);
                    } 
                   // if validation true then save input against model instance
                  else
                    {
                         $DATA->name=$request->input('name');
                    }
            }
              // check price attribute 
           if($request->input('price') != "")
           {
                  // Validate price field
                  $validator = Validator::make($request->all(), [
                  'price' => 'bail|required|numeric|max:256',
                   ]);
                   // Check validation failure
                   if ($validator->fails()) 
                   {
                         $messege=$validator->messages()->getMessageBag();
                         return response()->json($messege);
                    } 
                    // if validation true then save input against model instance
                    else
                    {
                          $DATA->price=$request->input('price');
                    }
            } 
           if($request->input('quantity') != "")
           {
                   // Validate quantity field
                  $validator = Validator::make($request->all(), [
                  'quantity' => 'bail|required|numeric|max:255',
                  ]);
                   // Check validation failure
                 if ($validator->fails()) 
                   {
                          $messege=$validator->messages()->getMessageBag();
                          return response()->json($messege);
                    } 
                      // if validation true then save input against model instance
                  else
                   {   
                         $DATA->quantity=$request->input('quantity');
                    }
            } 
          if($request->input('category') != "")
           {
                   // Validate category field
                  $validator = Validator::make($request->all(), [
                  'category' => 'bail|required|max:255|alpha_num',
                  ]);
                    // Check validation failure
                 if ($validator->fails()) 
                   {
                         $messege=$validator->messages()->getMessageBag();
                         return response()->json($messege);
                    } 
                   // if validation true then save input against model instance
                  else
                   {  
                         $DATA->category=$request->input('category');
                    }
           } 
             // if validation true then save input against model instance
        $DATA->save();
        return response()->json($DATA);
    }
}
