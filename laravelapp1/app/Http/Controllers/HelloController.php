<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;

class HelloController extends Controller
{
    public function index(Request $request){
        
        /*$user=Auth::user();
        $sort=$request->sort;
        $items=Person::orderBy($sort,'asc')
            ->simplePaginate(5);
        $param=['items'=>$items,'sort'=>$sort,
        'user'=>$user];
        return view('hello.index',$param);*/

       // return view('hello.index');

        if (Auth::check()) {
            return view('hello.index');
        } else {
            // ログインしていなかったら、Login画面を表示
            return view('auth/login');
        }
    }



    public function ban(Request $request){
      //  return view('hello.ban');

        if (Auth::check()) {
            return view('hello.ban');
        } else {
            // ログインしていなかったら、Login画面を表示
            return view('auth/login');
        }
        
        
    }


    public function cmmeta(Request $request){
        //  return view('hello.ban');
  
          if (Auth::check()) {
              return view('hello.cmmeta');
          } else {
              // ログインしていなかったら、Login画面を表示
              return view('auth/login');
          }
          
          
      }



    public function post(Request $request){
        $items=DB::select('select * from people');
        return view('hello.index',['items'=>$items]);
    }


    public function cmread(Request $request){
        $file = $request->file('file');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        $xmlData = simplexml_load_file($xml);//xmlを読み込む

       // $cm_code_advertiser_id=$xmlData->CM_sponsor_name->attributes();

        $cm_code_advertiser_id=$xmlData->cm_code_advertiser_id;
        $cm_code_material_id=$xmlData->cm_code_material_id;
        $CM_name=$xmlData->CM_name;
        $CM_original_name=$xmlData->CM_original_name;
        $product_name=$xmlData->product_name;
        $CM_sponsor_name=$xmlData->CM_sponsor_name;
        $production_ADcompany_name=$xmlData->production_ADcompany_name;
        $production_ADcompany_name_code=$xmlData->production_ADcompany_name->attributes();
        $production_company_name=$xmlData->production_company_name;
        $production_company_name_code=$xmlData->production_company_name->attributes();
        $CM_duration=$xmlData->CM_duration;
        $media_type=$xmlData->media_type->attributes();

        if($media_type=="15"){
            $media_typef="1";
        }elseif($media_type=="16"){
            $media_typef="2";
        }

        $TC_count_mode=$xmlData->TC_count_mode->attributes();

        if($TC_count_mode=="1"){
            $TC_count_modef="1";
        }elseif($TC_count_mode=="2"){
            $TC_count_modef="2";
        }

        $video_definition_mode=$xmlData->video_definition_mode->attributes();

        if($video_definition_mode=="1"){
            $video_definition_modef="1";
        }elseif($video_definition_mode=="2"){
            $video_definition_modef="2";
        }

        $video_aspect_ratio=$xmlData->video_aspect_ratio->attributes();

        if($video_aspect_ratio=="1"){
            $video_aspect_ratiof="1";
        }elseif($video_aspect_ratio=="2"){
            $video_aspect_ratiof="2";
        }

        $audio_format=$xmlData->audio_format->attributes();

        if($audio_format=="1"){
            $audio_formatf="1";
        }elseif($audio_format=="2"){
            $audio_formatf="2";
        }

        $start_timecode=$xmlData->start_timecode;

        $start_timecode=substr($start_timecode, 0, 2).":".substr($start_timecode, 2, 2).":".substr($start_timecode, 4, 2).":".substr($start_timecode, 6, 2);

        $CM_caption_existence=$xmlData->CM_caption_existence->attributes();

        if($CM_caption_existence=="0"){
            $CM_caption_existencef="1";
        }elseif($CM_caption_existence=="1"){
            $CM_caption_existencef="2";
        }

        $remarks_column=$xmlData->remarks_column;

        $user_area_1=$xmlData->memo->user_area_1;
        $user_area_2=$xmlData->memo->user_area_2;
        $user_area_3=$xmlData->memo->user_area_3;

        $cm_meta_version_number=$xmlData->version->cm_meta_version_number;

        $cm_meta_version_number=substr($cm_meta_version_number, 0, 1).".".substr($start_timecode, 1, 1).".".substr($start_timecode, 2, 1);


        $params=[
            'cm_code_advertiser_id'=>$cm_code_advertiser_id,
            'cm_code_material_id'=>$cm_code_material_id,
            'CM_name'=>$CM_name,
            'CM_original_name'=>$CM_original_name,
            'product_name'=>$product_name,
            'CM_sponsor_name'=>$CM_sponsor_name,
            'production_ADcompany_name'=>$production_ADcompany_name,
            'production_ADcompany_name_code'=>$production_ADcompany_name_code,
            'production_company_name'=>$production_company_name,
            'production_company_name_code'=>$production_company_name_code,
            'CM_duration'=>$CM_duration,
            'media_typef'=>$media_typef,
            'TC_count_modef'=>$TC_count_modef,
            'video_definition_modef'=>$video_definition_modef,
            'video_aspect_ratiof'=>$video_aspect_ratiof,
            'audio_formatf'=>$audio_formatf,
            'start_timecode'=>$start_timecode,
            'CM_caption_existencef'=>$CM_caption_existencef,
            'remarks_column'=>$remarks_column,
            'user_area_1'=>$user_area_1,
            'user_area_2'=>$user_area_2,
            'user_area_3'=>$user_area_3,
            
        ];
        return view('hello.cmmeta',['items'=>$params]);


        
    }


    public function csvread(Request $request){
        $file = $request->file('cmfile');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        // 読み込み用にtest.csvを開きます。
        $f = fopen("$xml", "r");
        // test.csvの行を1行ずつ読み込みます。
        while($line = fgetcsv($f)){
        // 読み込んだ結果を表示します。
         //var_dump($line);
         $cm_code_advertiser_id=$line[0];
         $cm_code_material_id=$line[1];
         $CM_name=$line[2];
         $CM_original_name=$line[3];
         $product_name=$line[4];
         $CM_sponsor_name=$line[5];
         $production_ADcompany_name=$line[7];
         $production_ADcompany_name_code=$line[8];
         $production_company_name=$line[9];
         $production_company_name_code=$line[10];
         $CM_duration=$line[11];
         $media_type=$line[13];
            if($media_type=="15"){
                $media_typef="1";
            }elseif($media_type=="16"){
                $media_typef="2";
            }

            $TC_count_mode=$line[15];
            if($TC_count_mode=="1"){
                $TC_count_modef="1";
            }elseif($TC_count_mode=="2"){
                $TC_count_modef="2";
            }

            $video_definition_mode=$line[17];

            if($video_definition_mode=="1"){
                $video_definition_modef="1";
            }elseif($video_definition_mode=="2"){
                $video_definition_modef="2";
            }

            $video_aspect_ratio=$line[19];

            if($video_aspect_ratio=="1"){
                $video_aspect_ratiof="1";
            }elseif($video_aspect_ratio=="2"){
                $video_aspect_ratiof="2";
            }  

            $audio_format=$line[21];

            if($audio_format=="1"){
                $audio_formatf="1";
            }elseif($audio_format=="2"){
                $audio_formatf="2";
            }

            $start_timecode=$line[22];

             $start_timecode=substr($start_timecode, 0, 2).":".substr($start_timecode, 2, 2).":".substr($start_timecode, 4, 2).":".substr($start_timecode, 6, 2);

             $CM_caption_existence=$line[24];

             if($CM_caption_existence=="0"){
                 $CM_caption_existencef="1";
             }elseif($CM_caption_existence=="1"){
                 $CM_caption_existencef="2";
             }

             $remarks_column=$line[27];
             $user_area_1=$line[28];
             $user_area_2=$line[29];
             $user_area_3=$line[30];


             //$cm_meta_version_number=$line[28];

           // $cm_meta_version_number=substr($cm_meta_version_number, 0, 1).".".substr($start_timecode, 1, 1).".".substr($start_timecode, 2, 1);



         
        }
        // test.csvを閉じます。
        fclose($f);
       // $xmlData = simplexml_load_file($xml);//xmlを読み込む

        //$cm_code_advertiser_id=$xmlData->CM_sponsor_name->attributes();

        $params=[
            'cm_code_advertiser_id'=>$cm_code_advertiser_id,
            'cm_code_material_id'=>$cm_code_material_id,
            'CM_name'=>$CM_name,
            'CM_original_name'=>$CM_original_name,
            'product_name'=>$product_name,
            'CM_sponsor_name'=>$CM_sponsor_name,
            'production_ADcompany_name'=>$production_ADcompany_name,
            'production_ADcompany_name_code'=>$production_ADcompany_name_code,
            'production_company_name'=>$production_company_name,
            'production_company_name_code'=>$production_company_name_code,
            'CM_duration'=>$CM_duration,
            'media_typef'=>$media_typef,
            'TC_count_modef'=>$TC_count_modef,
            'video_definition_modef'=>$video_definition_modef,
            'video_aspect_ratiof'=>$video_aspect_ratiof,
            'audio_formatf'=>$audio_formatf,
            'start_timecode'=>$start_timecode,
            'CM_caption_existencef'=>$CM_caption_existencef,
            'remarks_column'=>$remarks_column,
            'user_area_1'=>$user_area_1,
            'user_area_2'=>$user_area_2,
            'user_area_3'=>$user_area_3,



        ];
        return view('hello.cmmeta',['items'=>$params]);
        
    }

    public function banread(Request $request){
        
        $file = $request->file('file');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        $xmlData = simplexml_load_file($xml);//xmlを読み込む



        $fileid=substr($fileName, 4, -4);  

        $title=$xmlData->ProgramFramework->Titles->MainTitle;
        $subtitle=$xmlData->ProgramFramework->Titles->SecondaryTitle;

        foreach ($xmlData->ProgramFramework->GroupRelationship as $GroupRelationship) {
            if($GroupRelationship->ProgrammingGroupTitle=="回数"){
                $kaisuu=$GroupRelationship->NumericalPositionInSequence;
            }

            if($GroupRelationship->ProgrammingGroupTitle=="ロール番号"){
                $roll=$GroupRelationship->NumericalPositionInSequence;
            }

         }
        

        $roll1=substr($roll, 0, 2);
        if(substr($roll1, 0, 1)=="0"){
            $roll1=substr($roll1, 1, 1);
        }

        $roll2=substr($roll, 2, 3);
        if(substr($roll2, 0, 2)=="00"){
            $roll2=substr($roll2, 2, 1);
        }elseif(substr($roll2, 0, 1)=="0"){
            $roll2=substr($roll2, 3, 2);
        }

        $EventStartDateandTime=$xmlData->ProgramFramework->Event->EventStartDateandTime;

        $housoubi=substr($EventStartDateandTime, 0, 10);
        $housoujikoku=substr($EventStartDateandTime, 11, 8);

        $PublishingOrganizationName=$xmlData->ProgramFramework->Event->Publication->PublishingOrganizationName;

        $PublishingMediumName=$xmlData->ProgramFramework->Event->Publication->PublishingMediumName;

        if($PublishingMediumName==""){
            $oaf="0";
        }elseif($PublishingMediumName=="地上波"){
            $oaf="1";
        }elseif($PublishingMediumName=="BS"){
            $oaf="2";
        }elseif($PublishingMediumName=="CS"){
            $oaf="3";
        }elseif($PublishingMediumName=="裏送り"){
            $oaf="4";
        }elseif($PublishingMediumName=="その他"){
            $oaf="5";
        }

        


        $seisakunum=0;
        $seisaku_shokushu=[];
        $seisaku_sei=[];
        $seisaku_mei=[];
        $seisaku_kaisha=[];
        $seisaku_renraku=[];
        
        $sagyounum=0;
        $sagyou_sagyoubi=[];
        $sagyou_naiyou=[];
        $sagyou_sei=[];
        $sagyou_mei=[];
        $sagyou_kaisha=[];
        $sagyou_renraku=[];
        $sagyou_shuroku=[];

        foreach ($xmlData->ProgramFramework->Participant as $Participant) {
            if($Participant->JobFunction=="CP"){
                $seisakunum++;
                array_push($seisaku_shokushu, $Participant->ContributionStatus);
                array_push($seisaku_sei, $Participant->Person->FamilyName);
                array_push($seisaku_mei, $Participant->Person->FirstGivenName);
                array_push($seisaku_kaisha, $Participant->Person->Organization->OrganizationMainName);
                array_push($seisaku_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
            }

            if($Participant->JobFunction=="PP"){
                $sagyounum++;
                array_push($sagyou_sagyoubi, substr($Participant->ContributionDate, 0, 10));
                if($Participant->ContributionStatus=="REC"){
                    $sagyou_naiyou_pp="0";
                }else if($Participant->ContributionStatus=="PB"){
                    $sagyou_naiyou_pp="1";
                }else if($Participant->ContributionStatus=="DUB"){
                    $sagyou_naiyou_pp="2";
                }else if($Participant->ContributionStatus=="ED"){
                    $sagyou_naiyou_pp="3";
                }else if($Participant->ContributionStatus=="ING"){
                    $sagyou_naiyou_pp="4";
                }else if($Participant->ContributionStatus=="MA"){
                    $sagyou_naiyou_pp="5";
                }else if($Participant->ContributionStatus=="PV"){
                    $sagyou_naiyou_pp="6";
                }else if($Participant->ContributionStatus=="OA"){
                    $sagyou_naiyou_pp="7";
                }else if($Participant->ContributionStatus=="(OA)"){
                    $sagyou_naiyou_pp="8";
                }else if($Participant->ContributionStatus=="ERA"){
                    $sagyou_naiyou_pp="9";
                }else if($Participant->ContributionStatus=="Meta"){
                    $sagyou_naiyou_pp="10";
                }else if($Participant->ContributionStatus=="その他"){
                    $sagyou_naiyou_pp="11";
                }
               array_push($sagyou_naiyou, $sagyou_naiyou_pp);
               array_push($sagyou_sei, $Participant->Person->FamilyName);
               array_push($sagyou_mei, $Participant->Person->FirstGivenName);
               array_push($sagyou_kaisha, $Participant->Person->Organization->OrganizationMainName);
               array_push($sagyou_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
               array_push($sagyou_shuroku, $Participant->Annotation->AnnotationDescription);
            }

         }



         $memo=$xmlData->ProgramFramework->Annotation->AnnotationDescription;

        $mediano=$xmlData->RollFramework->Identification->IdentifierValue;



        foreach ($xmlData->RollFramework->Annotation as $Annotation) {
            if($Annotation->AnnotationKind=="Format"){
                $mediaformat=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="Purpose"){
                $youto=$Annotation->AnnotationSynopsis;
            }elseif($Annotation->AnnotationKind=="MediaKind"){
                $mediashubetu=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="StopCode"){
                $stopmark=$Annotation->AnnotationDescription;
            }

         }


         if($youto==""){
             $youtof="0";
         }elseif($youto=="放送"){
            $youtof="1";
         }elseif($youto=="放送予備"){
            $youtof="2";
         }elseif($youto=="ネット"){
            $youtof="3";
         }elseif($youto=="保存"){
            $youtof="4";
         }elseif($youto=="裏送り"){
            $youtof="5";
         }elseif($youto=="番組管理"){
            $youtof="6";
         }elseif($youto=="素材"){
            $youtof="7";
         }elseif($youto=="素材予備"){
            $youtof="8";
         }elseif($youto=="その他"){
            $youtof="9";
         }else{
            $youtof="";
         }


         if($mediashubetu==""){
             $mediashubetuf="0";
         }elseif($mediashubetu=="XDCAM"){
            $mediashubetuf="1";
         }elseif($mediashubetu=="HDCAM"){
            $mediashubetuf="2";
         }elseif($mediashubetu=="HDCAM-SR"){
            $mediashubetuf="3";
         }else{
            $mediashubetuf="";
         }


        if($stopmark==""){
            $stopmarkf="0";
        }elseif($stopmark=="ストップマーク無し"){
            $stopmarkf="1";
        }elseif($stopmark=="ストップマーク有り"){
            $stopmarkf="2";
        }else{
            $stopmarkf="";
        }



        $honkai=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->EntryPoint;

        $honkai=substr($honkai, 0, 8);

        $honzen=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->TotalDuration;

        $honzen=substr($honzen, 0, 8);




        $ElectrospatialFormulation=$xmlData->RollFramework->AudioDescription->ElectrospatialFormulation;

        if($ElectrospatialFormulation==""){
            $onseimodef="0";
        }elseif($ElectrospatialFormulation=="1"){
            $onseimodef="1";
        }




         $blocknum=-1;
         $block_start=[];
         $block_end=[];
         $block_dur=[];
         $block_obj=[];
         $block_source=[];
         $block_bik=[];

         foreach ($xmlData->RollFramework->Block as $Block) {
            $blocknum++;
            array_push($block_start, substr($Block->BlockStartPosition, 0, 8));
            array_push($block_end, substr($Block->BlockEndPosition, 0, 8));
            array_push($block_dur, substr($Block->BlockDuration, 0, 8));
            if($Block->BlockDescription->BlockKind=="PG"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="1"){
                            $block_obj_bl="0";
                        }else{
                            $block_obj_bl="9";
                        }
                        
                    }

                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="R-1"){
                            $block_source_bl="1";
                        }else if($BlockSubInfo->BlockValue=="R-2"){
                            $block_source_bl="4";
                        }else if($BlockSubInfo->BlockValue=="R-3"){
                            $block_source_bl="7";
                        }else if($BlockSubInfo->BlockValue=="R-4"){
                            $block_source_bl="10";
                        }else if($BlockSubInfo->BlockValue=="R-5"){
                            $block_source_bl="13";
                        }else if($BlockSubInfo->BlockValue=="R-5"){
                            $block_source_bl="13";
                        }else if($BlockSubInfo->BlockValue=="R-6"){
                            $block_source_bl="16";
                        }else if($BlockSubInfo->BlockValue=="R-7"){
                            $block_source_bl="19";
                        }else if($BlockSubInfo->BlockValue=="R-8"){
                            $block_source_bl="22";
                        }else if($BlockSubInfo->BlockValue=="R-9"){
                            $block_source_bl="25";
                        }else if($BlockSubInfo->BlockValue=="R-10"){
                            $block_source_bl="28";
                        }else if($BlockSubInfo->BlockValue=="R-11"){
                            $block_source_bl="31";
                        }else if($BlockSubInfo->BlockValue=="R-12"){
                            $block_source_bl="33";
                        }else if($BlockSubInfo->BlockValue=="R-13"){
                            $block_source_bl="35";
                        }else if($BlockSubInfo->BlockValue=="R-14"){
                            $block_source_bl="37";
                        }else if($BlockSubInfo->BlockValue=="R-15"){
                            $block_source_bl="39";
                        }else if($BlockSubInfo->BlockValue=="R-16"){
                            $block_source_bl="41";
                        }else if($BlockSubInfo->BlockValue=="R-17"){
                            $block_source_bl="42";
                        }else if($BlockSubInfo->BlockValue=="R-18"){
                            $block_source_bl="43";
                        }else if($BlockSubInfo->BlockValue=="R-19"){
                            $block_source_bl="44";
                        }else if($BlockSubInfo->BlockValue=="R-20"){
                            $block_source_bl="45";
                        }
                        
                    }
                }
            }else if($Block->BlockDescription->BlockKind=="CM"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="0"){
                            $block_obj_bl="1";
                        }else{
                            $block_obj_bl="7";
                        }
                        
                    }


                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="CM1"){
                            $block_source_bl="2";
                        }else if($BlockSubInfo->BlockValue=="CM2"){
                            $block_source_bl="5";
                        }else if($BlockSubInfo->BlockValue=="CM3"){
                            $block_source_bl="8";
                        }else if($BlockSubInfo->BlockValue=="CM4"){
                            $block_source_bl="11";
                        }else if($BlockSubInfo->BlockValue=="CM5"){
                            $block_source_bl="14";
                        }else if($BlockSubInfo->BlockValue=="CM6"){
                            $block_source_bl="17";
                        }else if($BlockSubInfo->BlockValue=="CM7"){
                            $block_source_bl="20";
                        }else if($BlockSubInfo->BlockValue=="CM8"){
                            $block_source_bl="23";
                        }else if($BlockSubInfo->BlockValue=="CM9"){
                            $block_source_bl="26";
                        }else if($BlockSubInfo->BlockValue=="CM10"){
                            $block_source_bl="29";
                        }else if($BlockSubInfo->BlockValue=="CM11"){
                            $block_source_bl="32";
                        }else if($BlockSubInfo->BlockValue=="CM12"){
                            $block_source_bl="34";
                        }else if($BlockSubInfo->BlockValue=="CM13"){
                            $block_source_bl="36";
                        }else if($BlockSubInfo->BlockValue=="CM14"){
                            $block_source_bl="38";
                        }else if($BlockSubInfo->BlockValue=="CM15"){
                            $block_source_bl="40";
                        }
                        
                    }


                }
            }else if($Block->BlockDescription->BlockKind=="SC"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="0"){
                            $block_obj_bl="2";
                        }else if($BlockSubInfo->BlockValue=="1"){
                            $block_obj_bl="4";
                        }else if($BlockSubInfo->BlockValue=="2"){
                            $block_obj_bl="5";
                        }else if($BlockSubInfo->BlockValue=="3"){
                            $block_obj_bl="6";
                        }
                        
                    }

                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="提供1"){
                            $block_source_bl="3";
                        }else if($BlockSubInfo->BlockValue=="提供2"){
                            $block_source_bl="6";
                        }else if($BlockSubInfo->BlockValue=="提供3"){
                            $block_source_bl="9";
                        }else if($BlockSubInfo->BlockValue=="提供4"){
                            $block_source_bl="12";
                        }else if($BlockSubInfo->BlockValue=="提供5"){
                            $block_source_bl="15";
                        }else if($BlockSubInfo->BlockValue=="提供6"){
                            $block_source_bl="18";
                        }else if($BlockSubInfo->BlockValue=="提供7"){
                            $block_source_bl="21";
                        }else if($BlockSubInfo->BlockValue=="提供8"){
                            $block_source_bl="24";
                        }else if($BlockSubInfo->BlockValue=="提供9"){
                            $block_source_bl="27";
                        }else if($BlockSubInfo->BlockValue=="提供10"){
                            $block_source_bl="30";
                        }
                        
                    }
                }
            }else if($Block->BlockDescription->BlockKind=="BB"){
                $block_obj_bl="3";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="NS"){
                $block_obj_bl="8";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="CB"){
                $block_obj_bl="10";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="CR"){
                $block_obj_bl="11";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="LC"){
                $block_obj_bl="12";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="FC"){
                $block_obj_bl="13";
                $block_source_bl="0";
            }
            array_push($block_obj, $block_obj_bl);
            array_push($block_source, $block_source_bl);
            array_push($block_bik, $Block->BlockDescription->Annotation->AnnotationDescription);
         }



         $keynum=0;
         $key_start=[];
         $key_end=[];
         $key_dur=[];
         $key_shu=[];
         $key_nai=[];
         

         foreach ($xmlData->RollFramework->Keypoint as $Keypoint) {
            $keynum++;
            array_push($key_start, $Keypoint->KeypointPosition);
            array_push($key_end, $Keypoint->KeypointPosition);
            array_push($key_dur, $Keypoint->KeypointDuration);
            array_push($key_shu, $Keypoint->KeypointKind);
            array_push($key_nai, $Keypoint->KeypointValue);
         }
        

         
        $params=[
            'readfile'=>$fileName,
            'fileid'=>$fileid,
            'title'=>$title,
            'subtitle'=>$subtitle,
            'kaisuu'=>$kaisuu,

            'roll1'=>$roll1,
            'roll2'=>$roll2,

            'housoubi'=>$housoubi,
            'housoujikoku'=>$housoujikoku,

            'housoukyoku'=>$PublishingOrganizationName,

            'oaf'=>$oaf,
            


            'seisakunum'=>$seisakunum,
            'seisaku_shokushu'=>$seisaku_shokushu,
            'seisaku_sei'=>$seisaku_sei,
            'seisaku_mei'=>$seisaku_mei,
            'seisaku_kaisha'=>$seisaku_kaisha,
            'seisaku_renraku'=>$seisaku_renraku,


            'sagyounum'=>$sagyounum,
            'sagyou_sagyoubi'=>$sagyou_sagyoubi,
            'sagyou_naiyou'=>$sagyou_naiyou,
            'sagyou_sei'=>$sagyou_sei,
            'sagyou_mei'=>$sagyou_mei,
            'sagyou_kaisha'=>$sagyou_kaisha,
            'sagyou_renraku'=>$sagyou_renraku,
            'sagyou_shuroku'=>$sagyou_shuroku,


            'memo'=>$memo,
            'mediano'=>$mediano,

            'mediaformat'=>$mediaformat,
            'youtof'=>$youtof,
            'mediashubetuf'=>$mediashubetuf,
            'stopmarkf'=>$stopmarkf,

            'honkai'=>$honkai,
            'honzen'=>$honzen,

            'onseimodef'=>$onseimodef,




            'blocknum'=>$blocknum,
            'block_start'=>$block_start,
            'block_end'=>$block_end,
            'block_dur'=>$block_dur,
            'block_obj'=>$block_obj,
            'block_source'=>$block_source,
            'block_bik'=>$block_bik,

            'keynum'=>$keynum,
            'key_start'=>$key_start,
            'key_end'=>$key_end,
            'key_dur'=>$key_dur,
            'key_shu'=>$key_shu,
            'key_nai'=>$key_nai,
            
            
        ];
        return view('hello.ban',['items'=>$params]);






    }





    public function add(Request $request){
        
        $file = $request->file('file');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        $xmlData = simplexml_load_file($xml);//xmlを読み込む



        $fileid=substr($fileName, 4, -4);  

        $title=$xmlData->ProgramFramework->Titles->MainTitle;
        $subtitle=$xmlData->ProgramFramework->Titles->SecondaryTitle;

        foreach ($xmlData->ProgramFramework->GroupRelationship as $GroupRelationship) {
            if($GroupRelationship->ProgrammingGroupTitle=="回数"){
                $kaisuu=$GroupRelationship->NumericalPositionInSequence;
            }

            if($GroupRelationship->ProgrammingGroupTitle=="ロール番号"){
                $roll=$GroupRelationship->NumericalPositionInSequence;
            }

         }
        

        $roll1=substr($roll, 0, 2);
        if(substr($roll1, 0, 1)=="0"){
            $roll1=substr($roll1, 1, 1);
        }

        $roll2=substr($roll, 2, 3);
        if(substr($roll2, 0, 2)=="00"){
            $roll2=substr($roll2, 2, 1);
        }elseif(substr($roll2, 0, 1)=="0"){
            $roll2=substr($roll2, 3, 2);
        }

        $EventStartDateandTime=$xmlData->ProgramFramework->Event->EventStartDateandTime;

        $housoubi=substr($EventStartDateandTime, 0, 10);
        $housoujikoku=substr($EventStartDateandTime, 11, 8);

        $PublishingOrganizationName=$xmlData->ProgramFramework->Event->Publication->PublishingOrganizationName;

        $PublishingMediumName=$xmlData->ProgramFramework->Event->Publication->PublishingMediumName;

        $oaf="0";
        if($PublishingMediumName==""){
            $oaf="0";
        }elseif($PublishingMediumName=="地上波"){
            $oaf="1";
        }elseif($PublishingMediumName=="BS"){
            $oaf="2";
        }elseif($PublishingMediumName=="CS"){
            $oaf="3";
        }elseif($PublishingMediumName=="裏送り"){
            $oaf="4";
        }elseif($PublishingMediumName=="その他"){
            $oaf="5";
        }

        


        $seisakunum=0;
        $seisaku_shokushu=[];
        $seisaku_sei=[];
        $seisaku_mei=[];
        $seisaku_kaisha=[];
        $seisaku_renraku=[];
        
        $sagyounum=0;
        $sagyou_sagyoubi=[];
        $sagyou_naiyou=[];
        $sagyou_sei=[];
        $sagyou_mei=[];
        $sagyou_kaisha=[];
        $sagyou_renraku=[];
        $sagyou_shuroku=[];

        foreach ($xmlData->ProgramFramework->Participant as $Participant) {
            if($Participant->JobFunction=="CP"){
                $seisakunum++;
                array_push($seisaku_shokushu, $Participant->ContributionStatus);
                array_push($seisaku_sei, $Participant->Person->FamilyName);
                array_push($seisaku_mei, $Participant->Person->FirstGivenName);
                array_push($seisaku_kaisha, $Participant->Person->Organization->OrganizationMainName);
                array_push($seisaku_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
            }

            if($Participant->JobFunction=="PP"){
                $sagyounum++;
                array_push($sagyou_sagyoubi, substr($Participant->ContributionDate, 0, 10));
                if($Participant->ContributionStatus=="REC"){
                    $sagyou_naiyou_pp="0";
                }else if($Participant->ContributionStatus=="PB"){
                    $sagyou_naiyou_pp="1";
                }else if($Participant->ContributionStatus=="DUB"){
                    $sagyou_naiyou_pp="2";
                }else if($Participant->ContributionStatus=="ED"){
                    $sagyou_naiyou_pp="3";
                }else if($Participant->ContributionStatus=="ING"){
                    $sagyou_naiyou_pp="4";
                }else if($Participant->ContributionStatus=="MA"){
                    $sagyou_naiyou_pp="5";
                }else if($Participant->ContributionStatus=="PV"){
                    $sagyou_naiyou_pp="6";
                }else if($Participant->ContributionStatus=="OA"){
                    $sagyou_naiyou_pp="7";
                }else if($Participant->ContributionStatus=="(OA)"){
                    $sagyou_naiyou_pp="8";
                }else if($Participant->ContributionStatus=="ERA"){
                    $sagyou_naiyou_pp="9";
                }else if($Participant->ContributionStatus=="Meta"){
                    $sagyou_naiyou_pp="10";
                }else if($Participant->ContributionStatus=="その他"){
                    $sagyou_naiyou_pp="11";
                }
               array_push($sagyou_naiyou, $sagyou_naiyou_pp);
               array_push($sagyou_sei, $Participant->Person->FamilyName);
               array_push($sagyou_mei, $Participant->Person->FirstGivenName);
               array_push($sagyou_kaisha, $Participant->Person->Organization->OrganizationMainName);
               array_push($sagyou_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
               array_push($sagyou_shuroku, $Participant->Annotation->AnnotationDescription);
            }

         }



         $memo=$xmlData->ProgramFramework->Annotation->AnnotationDescription;

        $mediano=$xmlData->RollFramework->Identification->IdentifierValue;



        foreach ($xmlData->RollFramework->Annotation as $Annotation) {
            if($Annotation->AnnotationKind=="Format"){
                $mediaformat=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="Purpose"){
                $youto=$Annotation->AnnotationSynopsis;
            }elseif($Annotation->AnnotationKind=="MediaKind"){
                $mediashubetu=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="StopCode"){
                $stopmark=$Annotation->AnnotationDescription;
            }

         }


         if($youto==""){
             $youtof="0";
         }elseif($youto=="放送"){
            $youtof="1";
         }elseif($youto=="放送予備"){
            $youtof="2";
         }elseif($youto=="ネット"){
            $youtof="3";
         }elseif($youto=="保存"){
            $youtof="4";
         }elseif($youto=="裏送り"){
            $youtof="5";
         }elseif($youto=="番組管理"){
            $youtof="6";
         }elseif($youto=="素材"){
            $youtof="7";
         }elseif($youto=="素材予備"){
            $youtof="8";
         }elseif($youto=="その他"){
            $youtof="9";
         }else{
            $youtof="";
         }


         if($mediashubetu==""){
             $mediashubetuf="0";
         }elseif($mediashubetu=="XDCAM"){
            $mediashubetuf="1";
         }elseif($mediashubetu=="HDCAM"){
            $mediashubetuf="2";
         }elseif($mediashubetu=="HDCAM-SR"){
            $mediashubetuf="3";
         }else{
            $mediashubetuf="";
         }


        if($stopmark==""){
            $stopmarkf="0";
        }elseif($stopmark=="ストップマーク無し"){
            $stopmarkf="1";
        }elseif($stopmark=="ストップマーク有り"){
            $stopmarkf="2";
        }else{
            $stopmarkf="";
        }



        $honkai=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->EntryPoint;

        $honkai=substr($honkai, 0, 8);

        $honzen=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->TotalDuration;

        $honzen=substr($honzen, 0, 8);




        $ElectrospatialFormulation=$xmlData->RollFramework->AudioDescription->ElectrospatialFormulation;

        $ch01f="0";
        $ch02f="0";
        $ch03f="0";
        $ch04f="0";
        $ch05f="0";
        $ch06f="0";
        $ch07f="0";
        $ch08f="0";

        $roudnessf="0";
        $roudnessmainaudio="";
        $roudnesssubaudio="";
        $roudnesssanaudio="";
        $truepeakmainaudio="";
        $truepeaksubaudio="";
        $truepeaksanaudio="";


        if($ElectrospatialFormulation==""){
            $onseimodef="0";
        }elseif($ElectrospatialFormulation=="0"){
            $onseimodef="2";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }
            }
            $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
            foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                if($Annotation->AnnotationKind=="LongTermLoudness"){
                    $roudness=$Annotation->AnnotationSynopsis;
                    if($roudness==""){
                        $roudnessf="0";
                    }elseif($roudness=="テープ毎"){
                        $roudnessf="1";
                    }elseif($roudness=="総尺"){
                        $roudnessf="2";
                    }
                }

                if($Annotation->AnnotationKind=="TruePeak"){
                    $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                }
            }

        }elseif($ElectrospatialFormulation=="1"){
            $onseimodef="1";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }
            }

            $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
            foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                if($Annotation->AnnotationKind=="LongTermLoudness"){
                    $roudness=$Annotation->AnnotationSynopsis;
                    if($roudness==""){
                        $roudnessf="0";
                    }elseif($roudness=="テープ毎"){
                        $roudnessf="1";
                    }elseif($roudness=="総尺"){
                        $roudnessf="2";
                    }
                }

                if($Annotation->AnnotationKind=="TruePeak"){
                    $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                }
            }

        }elseif($ElectrospatialFormulation=="2"){
            $onseimodef="3";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }
            }

            $audioc=0;
            foreach ($xmlData->RollFramework->AudioDescription->Loudness as $Loudness) {
                if($audioc==0){
                    $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }elseif($audioc==1){
                    $roudnesssubaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeaksubaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                }
            }
            

        }elseif($ElectrospatialFormulation=="3"){
            $onseimodef="4";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }elseif($ChannelObject->attributes()=="3"){
                    $ch03=$ChannelObject->ChannelAssignment;
                    if($ch03==""){
                        $ch03f="0";
                    }elseif($ch03=="L"){
                        $ch03f="1";
                    }elseif($ch03=="R"){
                        $ch03f="2";
                    }elseif($ch03=="MIX L"){
                        $ch03f="3";
                    }elseif($ch03=="MIX R"){
                        $ch03f="4";
                    }elseif($ch03=="MONO"){
                        $ch03f="5";
                    }elseif($ch03=="主音声"){
                        $ch03f="6";
                    }elseif($ch03=="副音声"){
                        $ch03f="7";
                    }elseif($ch03=="副音声1"){
                        $ch03f="8";
                    }elseif($ch03=="副音声2"){
                        $ch03f="9";
                    }elseif($ch03=="主音声L"){
                        $ch03f="10";
                    }elseif($ch03=="主音声R"){
                        $ch03f="11";
                    }elseif($ch03=="副音声L"){
                        $ch03f="12";
                    }elseif($ch03=="副音声R"){
                        $ch03f="13";
                    }elseif($ch03=="C"){
                        $ch03f="14";
                    }elseif($ch03=="LFE"){
                        $ch03f="15";
                    }elseif($ch03=="SL"){
                        $ch03f="16";
                    }elseif($ch03=="SR"){
                        $ch03f="17";
                    }elseif($ch03=="その他"){
                        $ch03f="18";
                    }
                }
            }

            $audioc=0;
            foreach ($xmlData->RollFramework->AudioDescription->Loudness as $Loudness) {
                if($audioc==0){
                    $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }elseif($audioc==1){
                    $roudnesssubaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeaksubaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }elseif($audioc==2){
                    $roudnesssanaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeaksanaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                }
            }
            

        }elseif($ElectrospatialFormulation=="4"){
            $onseimodef="5";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }elseif($ChannelObject->attributes()=="3"){
                    $ch03=$ChannelObject->ChannelAssignment;
                    if($ch03==""){
                        $ch03f="0";
                    }elseif($ch03=="L"){
                        $ch03f="1";
                    }elseif($ch03=="R"){
                        $ch03f="2";
                    }elseif($ch03=="MIX L"){
                        $ch03f="3";
                    }elseif($ch03=="MIX R"){
                        $ch03f="4";
                    }elseif($ch03=="MONO"){
                        $ch03f="5";
                    }elseif($ch03=="主音声"){
                        $ch03f="6";
                    }elseif($ch03=="副音声"){
                        $ch03f="7";
                    }elseif($ch03=="副音声1"){
                        $ch03f="8";
                    }elseif($ch03=="副音声2"){
                        $ch03f="9";
                    }elseif($ch03=="主音声L"){
                        $ch03f="10";
                    }elseif($ch03=="主音声R"){
                        $ch03f="11";
                    }elseif($ch03=="副音声L"){
                        $ch03f="12";
                    }elseif($ch03=="副音声R"){
                        $ch03f="13";
                    }elseif($ch03=="C"){
                        $ch03f="14";
                    }elseif($ch03=="LFE"){
                        $ch03f="15";
                    }elseif($ch03=="SL"){
                        $ch03f="16";
                    }elseif($ch03=="SR"){
                        $ch03f="17";
                    }elseif($ch03=="その他"){
                        $ch03f="18";
                    }
                }elseif($ChannelObject->attributes()=="4"){
                    $ch04=$ChannelObject->ChannelAssignment;
                    if($ch04==""){
                        $ch04f="0";
                    }elseif($ch04=="L"){
                        $ch04f="1";
                    }elseif($ch04=="R"){
                        $ch04f="2";
                    }elseif($ch04=="MIX L"){
                        $ch04f="3";
                    }elseif($ch04=="MIX R"){
                        $ch04f="4";
                    }elseif($ch04=="MONO"){
                        $ch04f="5";
                    }elseif($ch04=="主音声"){
                        $ch04f="6";
                    }elseif($ch04=="副音声"){
                        $ch04f="7";
                    }elseif($ch04=="副音声1"){
                        $ch04f="8";
                    }elseif($ch04=="副音声2"){
                        $ch04f="9";
                    }elseif($ch04=="主音声L"){
                        $ch04f="10";
                    }elseif($ch04=="主音声R"){
                        $ch04f="11";
                    }elseif($ch04=="副音声L"){
                        $ch04f="12";
                    }elseif($ch04=="副音声R"){
                        $ch04f="13";
                    }elseif($ch04=="C"){
                        $ch04f="14";
                    }elseif($ch04=="LFE"){
                        $ch04f="15";
                    }elseif($ch04=="SL"){
                        $ch04f="16";
                    }elseif($ch04=="SR"){
                        $ch04f="17";
                    }elseif($ch04=="その他"){
                        $ch04f="18";
                    }
                }
            }

            $audioc=0;
            foreach ($xmlData->RollFramework->AudioDescription->Loudness as $Loudness) {
                if($audioc==0){
                    $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }elseif($audioc==1){
                    $roudnesssubaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeaksubaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    
                }
            }
            

        }elseif($ElectrospatialFormulation=="6"){
            $onseimodef="6";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }elseif($ChannelObject->attributes()=="3"){
                    $ch03=$ChannelObject->ChannelAssignment;
                    if($ch03==""){
                        $ch03f="0";
                    }elseif($ch03=="L"){
                        $ch03f="1";
                    }elseif($ch03=="R"){
                        $ch03f="2";
                    }elseif($ch03=="MIX L"){
                        $ch03f="3";
                    }elseif($ch03=="MIX R"){
                        $ch03f="4";
                    }elseif($ch03=="MONO"){
                        $ch03f="5";
                    }elseif($ch03=="主音声"){
                        $ch03f="6";
                    }elseif($ch03=="副音声"){
                        $ch03f="7";
                    }elseif($ch03=="副音声1"){
                        $ch03f="8";
                    }elseif($ch03=="副音声2"){
                        $ch03f="9";
                    }elseif($ch03=="主音声L"){
                        $ch03f="10";
                    }elseif($ch03=="主音声R"){
                        $ch03f="11";
                    }elseif($ch03=="副音声L"){
                        $ch03f="12";
                    }elseif($ch03=="副音声R"){
                        $ch03f="13";
                    }elseif($ch03=="C"){
                        $ch03f="14";
                    }elseif($ch03=="LFE"){
                        $ch03f="15";
                    }elseif($ch03=="SL"){
                        $ch03f="16";
                    }elseif($ch03=="SR"){
                        $ch03f="17";
                    }elseif($ch03=="その他"){
                        $ch03f="18";
                    }
                }elseif($ChannelObject->attributes()=="4"){
                    $ch04=$ChannelObject->ChannelAssignment;
                    if($ch04==""){
                        $ch04f="0";
                    }elseif($ch04=="L"){
                        $ch04f="1";
                    }elseif($ch04=="R"){
                        $ch04f="2";
                    }elseif($ch04=="MIX L"){
                        $ch04f="3";
                    }elseif($ch04=="MIX R"){
                        $ch04f="4";
                    }elseif($ch04=="MONO"){
                        $ch04f="5";
                    }elseif($ch04=="主音声"){
                        $ch04f="6";
                    }elseif($ch04=="副音声"){
                        $ch04f="7";
                    }elseif($ch04=="副音声1"){
                        $ch04f="8";
                    }elseif($ch04=="副音声2"){
                        $ch04f="9";
                    }elseif($ch04=="主音声L"){
                        $ch04f="10";
                    }elseif($ch04=="主音声R"){
                        $ch04f="11";
                    }elseif($ch04=="副音声L"){
                        $ch04f="12";
                    }elseif($ch04=="副音声R"){
                        $ch04f="13";
                    }elseif($ch04=="C"){
                        $ch04f="14";
                    }elseif($ch04=="LFE"){
                        $ch04f="15";
                    }elseif($ch04=="SL"){
                        $ch04f="16";
                    }elseif($ch04=="SR"){
                        $ch04f="17";
                    }elseif($ch04=="その他"){
                        $ch04f="18";
                    }
                }elseif($ChannelObject->attributes()=="5"){
                    $ch05=$ChannelObject->ChannelAssignment;
                    if($ch05==""){
                        $ch05f="0";
                    }elseif($ch05=="L"){
                        $ch05f="1";
                    }elseif($ch05=="R"){
                        $ch05f="2";
                    }elseif($ch05=="MIX L"){
                        $ch05f="3";
                    }elseif($ch05=="MIX R"){
                        $ch05f="4";
                    }elseif($ch05=="MONO"){
                        $ch05f="5";
                    }elseif($ch05=="主音声"){
                        $ch05f="6";
                    }elseif($ch05=="副音声"){
                        $ch05f="7";
                    }elseif($ch05=="副音声1"){
                        $ch05f="8";
                    }elseif($ch05=="副音声2"){
                        $ch05f="9";
                    }elseif($ch05=="主音声L"){
                        $ch05f="10";
                    }elseif($ch05=="主音声R"){
                        $ch05f="11";
                    }elseif($ch05=="副音声L"){
                        $ch05f="12";
                    }elseif($ch05=="副音声R"){
                        $ch05f="13";
                    }elseif($ch05=="C"){
                        $ch05f="14";
                    }elseif($ch05=="LFE"){
                        $ch05f="15";
                    }elseif($ch05=="SL"){
                        $ch05f="16";
                    }elseif($ch05=="SR"){
                        $ch05f="17";
                    }elseif($ch05=="その他"){
                        $ch05f="18";
                    }
                }elseif($ChannelObject->attributes()=="6"){
                    $ch06=$ChannelObject->ChannelAssignment;
                    if($ch06==""){
                        $ch06f="0";
                    }elseif($ch06=="L"){
                        $ch06f="1";
                    }elseif($ch06=="R"){
                        $ch06f="2";
                    }elseif($ch06=="MIX L"){
                        $ch06f="3";
                    }elseif($ch06=="MIX R"){
                        $ch06f="4";
                    }elseif($ch06=="MONO"){
                        $ch06f="5";
                    }elseif($ch06=="主音声"){
                        $ch06f="6";
                    }elseif($ch06=="副音声"){
                        $ch06f="7";
                    }elseif($ch06=="副音声1"){
                        $ch06f="8";
                    }elseif($ch06=="副音声2"){
                        $ch06f="9";
                    }elseif($ch06=="主音声L"){
                        $ch06f="10";
                    }elseif($ch06=="主音声R"){
                        $ch06f="11";
                    }elseif($ch06=="副音声L"){
                        $ch06f="12";
                    }elseif($ch06=="副音声R"){
                        $ch06f="13";
                    }elseif($ch06=="C"){
                        $ch06f="14";
                    }elseif($ch06=="LFE"){
                        $ch06f="15";
                    }elseif($ch06=="SL"){
                        $ch06f="16";
                    }elseif($ch06=="SR"){
                        $ch06f="17";
                    }elseif($ch06=="その他"){
                        $ch06f="18";
                    }
                }
            }

            $audioc=0;
            foreach ($xmlData->RollFramework->AudioDescription->Loudness as $Loudness) {
                if($audioc==0){
                    $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }
            }
            

        }elseif($ElectrospatialFormulation=="8"){
            $onseimodef="7";
            foreach ($xmlData->RollFramework->AudioDescription->ChannelList->ChannelObject as $ChannelObject) {
                if($ChannelObject->attributes()=="1"){
                    $ch01=$ChannelObject->ChannelAssignment;
                    if($ch01==""){
                        $ch01f="0";
                    }elseif($ch01=="L"){
                        $ch01f="1";
                    }elseif($ch01=="R"){
                        $ch01f="2";
                    }elseif($ch01=="MIX L"){
                        $ch01f="3";
                    }elseif($ch01=="MIX R"){
                        $ch01f="4";
                    }elseif($ch01=="MONO"){
                        $ch01f="5";
                    }elseif($ch01=="主音声"){
                        $ch01f="6";
                    }elseif($ch01=="副音声"){
                        $ch01f="7";
                    }elseif($ch01=="副音声1"){
                        $ch01f="8";
                    }elseif($ch01=="副音声2"){
                        $ch01f="9";
                    }elseif($ch01=="主音声L"){
                        $ch01f="10";
                    }elseif($ch01=="主音声R"){
                        $ch01f="11";
                    }elseif($ch01=="副音声L"){
                        $ch01f="12";
                    }elseif($ch01=="副音声R"){
                        $ch01f="13";
                    }elseif($ch01=="C"){
                        $ch01f="14";
                    }elseif($ch01=="LFE"){
                        $ch01f="15";
                    }elseif($ch01=="SL"){
                        $ch01f="16";
                    }elseif($ch01=="SR"){
                        $ch01f="17";
                    }elseif($ch01=="その他"){
                        $ch01f="18";
                    }
                }elseif($ChannelObject->attributes()=="2"){
                    $ch02=$ChannelObject->ChannelAssignment;
                    if($ch02==""){
                        $ch02f="0";
                    }elseif($ch02=="L"){
                        $ch02f="1";
                    }elseif($ch02=="R"){
                        $ch02f="2";
                    }elseif($ch02=="MIX L"){
                        $ch02f="3";
                    }elseif($ch02=="MIX R"){
                        $ch02f="4";
                    }elseif($ch02=="MONO"){
                        $ch02f="5";
                    }elseif($ch02=="主音声"){
                        $ch02f="6";
                    }elseif($ch02=="副音声"){
                        $ch02f="7";
                    }elseif($ch02=="副音声1"){
                        $ch02f="8";
                    }elseif($ch02=="副音声2"){
                        $ch02f="9";
                    }elseif($ch02=="主音声L"){
                        $ch02f="10";
                    }elseif($ch02=="主音声R"){
                        $ch02f="11";
                    }elseif($ch02=="副音声L"){
                        $ch02f="12";
                    }elseif($ch02=="副音声R"){
                        $ch02f="13";
                    }elseif($ch02=="C"){
                        $ch02f="14";
                    }elseif($ch02=="LFE"){
                        $ch02f="15";
                    }elseif($ch02=="SL"){
                        $ch02f="16";
                    }elseif($ch02=="SR"){
                        $ch02f="17";
                    }elseif($ch02=="その他"){
                        $ch02f="18";
                    }
                }elseif($ChannelObject->attributes()=="3"){
                    $ch03=$ChannelObject->ChannelAssignment;
                    if($ch03==""){
                        $ch03f="0";
                    }elseif($ch03=="L"){
                        $ch03f="1";
                    }elseif($ch03=="R"){
                        $ch03f="2";
                    }elseif($ch03=="MIX L"){
                        $ch03f="3";
                    }elseif($ch03=="MIX R"){
                        $ch03f="4";
                    }elseif($ch03=="MONO"){
                        $ch03f="5";
                    }elseif($ch03=="主音声"){
                        $ch03f="6";
                    }elseif($ch03=="副音声"){
                        $ch03f="7";
                    }elseif($ch03=="副音声1"){
                        $ch03f="8";
                    }elseif($ch03=="副音声2"){
                        $ch03f="9";
                    }elseif($ch03=="主音声L"){
                        $ch03f="10";
                    }elseif($ch03=="主音声R"){
                        $ch03f="11";
                    }elseif($ch03=="副音声L"){
                        $ch03f="12";
                    }elseif($ch03=="副音声R"){
                        $ch03f="13";
                    }elseif($ch03=="C"){
                        $ch03f="14";
                    }elseif($ch03=="LFE"){
                        $ch03f="15";
                    }elseif($ch03=="SL"){
                        $ch03f="16";
                    }elseif($ch03=="SR"){
                        $ch03f="17";
                    }elseif($ch03=="その他"){
                        $ch03f="18";
                    }
                }elseif($ChannelObject->attributes()=="4"){
                    $ch04=$ChannelObject->ChannelAssignment;
                    if($ch04==""){
                        $ch04f="0";
                    }elseif($ch04=="L"){
                        $ch04f="1";
                    }elseif($ch04=="R"){
                        $ch04f="2";
                    }elseif($ch04=="MIX L"){
                        $ch04f="3";
                    }elseif($ch04=="MIX R"){
                        $ch04f="4";
                    }elseif($ch04=="MONO"){
                        $ch04f="5";
                    }elseif($ch04=="主音声"){
                        $ch04f="6";
                    }elseif($ch04=="副音声"){
                        $ch04f="7";
                    }elseif($ch04=="副音声1"){
                        $ch04f="8";
                    }elseif($ch04=="副音声2"){
                        $ch04f="9";
                    }elseif($ch04=="主音声L"){
                        $ch04f="10";
                    }elseif($ch04=="主音声R"){
                        $ch04f="11";
                    }elseif($ch04=="副音声L"){
                        $ch04f="12";
                    }elseif($ch04=="副音声R"){
                        $ch04f="13";
                    }elseif($ch04=="C"){
                        $ch04f="14";
                    }elseif($ch04=="LFE"){
                        $ch04f="15";
                    }elseif($ch04=="SL"){
                        $ch04f="16";
                    }elseif($ch04=="SR"){
                        $ch04f="17";
                    }elseif($ch04=="その他"){
                        $ch04f="18";
                    }
                }elseif($ChannelObject->attributes()=="5"){
                    $ch05=$ChannelObject->ChannelAssignment;
                    if($ch05==""){
                        $ch05f="0";
                    }elseif($ch05=="L"){
                        $ch05f="1";
                    }elseif($ch05=="R"){
                        $ch05f="2";
                    }elseif($ch05=="MIX L"){
                        $ch05f="3";
                    }elseif($ch05=="MIX R"){
                        $ch05f="4";
                    }elseif($ch05=="MONO"){
                        $ch05f="5";
                    }elseif($ch05=="主音声"){
                        $ch05f="6";
                    }elseif($ch05=="副音声"){
                        $ch05f="7";
                    }elseif($ch05=="副音声1"){
                        $ch05f="8";
                    }elseif($ch05=="副音声2"){
                        $ch05f="9";
                    }elseif($ch05=="主音声L"){
                        $ch05f="10";
                    }elseif($ch05=="主音声R"){
                        $ch05f="11";
                    }elseif($ch05=="副音声L"){
                        $ch05f="12";
                    }elseif($ch05=="副音声R"){
                        $ch05f="13";
                    }elseif($ch05=="C"){
                        $ch05f="14";
                    }elseif($ch05=="LFE"){
                        $ch05f="15";
                    }elseif($ch05=="SL"){
                        $ch05f="16";
                    }elseif($ch05=="SR"){
                        $ch05f="17";
                    }elseif($ch05=="その他"){
                        $ch05f="18";
                    }
                }elseif($ChannelObject->attributes()=="6"){
                    $ch06=$ChannelObject->ChannelAssignment;
                    if($ch06==""){
                        $ch06f="0";
                    }elseif($ch06=="L"){
                        $ch06f="1";
                    }elseif($ch06=="R"){
                        $ch06f="2";
                    }elseif($ch06=="MIX L"){
                        $ch06f="3";
                    }elseif($ch06=="MIX R"){
                        $ch06f="4";
                    }elseif($ch06=="MONO"){
                        $ch06f="5";
                    }elseif($ch06=="主音声"){
                        $ch06f="6";
                    }elseif($ch06=="副音声"){
                        $ch06f="7";
                    }elseif($ch06=="副音声1"){
                        $ch06f="8";
                    }elseif($ch06=="副音声2"){
                        $ch06f="9";
                    }elseif($ch06=="主音声L"){
                        $ch06f="10";
                    }elseif($ch06=="主音声R"){
                        $ch06f="11";
                    }elseif($ch06=="副音声L"){
                        $ch06f="12";
                    }elseif($ch06=="副音声R"){
                        $ch06f="13";
                    }elseif($ch06=="C"){
                        $ch06f="14";
                    }elseif($ch06=="LFE"){
                        $ch06f="15";
                    }elseif($ch06=="SL"){
                        $ch06f="16";
                    }elseif($ch06=="SR"){
                        $ch06f="17";
                    }elseif($ch06=="その他"){
                        $ch06f="18";
                    }
                }elseif($ChannelObject->attributes()=="7"){
                    $ch07=$ChannelObject->ChannelAssignment;
                    if($ch07==""){
                        $ch07f="0";
                    }elseif($ch07=="L"){
                        $ch07f="1";
                    }elseif($ch07=="R"){
                        $ch07f="2";
                    }elseif($ch07=="MIX L"){
                        $ch07f="3";
                    }elseif($ch07=="MIX R"){
                        $ch07f="4";
                    }elseif($ch07=="MONO"){
                        $ch07f="5";
                    }elseif($ch07=="主音声"){
                        $ch07f="6";
                    }elseif($ch07=="副音声"){
                        $ch07f="7";
                    }elseif($ch07=="副音声1"){
                        $ch07f="8";
                    }elseif($ch07=="副音声2"){
                        $ch07f="9";
                    }elseif($ch07=="主音声L"){
                        $ch07f="10";
                    }elseif($ch07=="主音声R"){
                        $ch07f="11";
                    }elseif($ch07=="副音声L"){
                        $ch07f="12";
                    }elseif($ch07=="副音声R"){
                        $ch07f="13";
                    }elseif($ch07=="C"){
                        $ch07f="14";
                    }elseif($ch07=="LFE"){
                        $ch07f="15";
                    }elseif($ch07=="SL"){
                        $ch07f="16";
                    }elseif($ch07=="SR"){
                        $ch07f="17";
                    }elseif($ch07=="その他"){
                        $ch07f="18";
                    }
                }elseif($ChannelObject->attributes()=="8"){
                    $ch08=$ChannelObject->ChannelAssignment;
                    if($ch08==""){
                        $ch08f="0";
                    }elseif($ch08=="L"){
                        $ch08f="1";
                    }elseif($ch08=="R"){
                        $ch08f="2";
                    }elseif($ch08=="MIX L"){
                        $ch08f="3";
                    }elseif($ch08=="MIX R"){
                        $ch08f="4";
                    }elseif($ch08=="MONO"){
                        $ch08f="5";
                    }elseif($ch08=="主音声"){
                        $ch08f="6";
                    }elseif($ch08=="副音声"){
                        $ch08f="7";
                    }elseif($ch08=="副音声1"){
                        $ch08f="8";
                    }elseif($ch08=="副音声2"){
                        $ch08f="9";
                    }elseif($ch08=="主音声L"){
                        $ch08f="10";
                    }elseif($ch08=="主音声R"){
                        $ch08f="11";
                    }elseif($ch08=="副音声L"){
                        $ch08f="12";
                    }elseif($ch08=="副音声R"){
                        $ch08f="13";
                    }elseif($ch08=="C"){
                        $ch08f="14";
                    }elseif($ch08=="LFE"){
                        $ch08f="15";
                    }elseif($ch08=="SL"){
                        $ch08f="16";
                    }elseif($ch08=="SR"){
                        $ch08f="17";
                    }elseif($ch08=="その他"){
                        $ch08f="18";
                    }
                }
            }

            $audioc=0;
            foreach ($xmlData->RollFramework->AudioDescription->Loudness as $Loudness) {
                if($audioc==0){
                    $roudnessmainaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        if($Annotation->AnnotationKind=="LongTermLoudness"){
                            $roudness=$Annotation->AnnotationSynopsis;
                            if($roudness==""){
                                $roudnessf="0";
                            }elseif($roudness=="テープ毎"){
                                $roudnessf="1";
                            }elseif($roudness=="総尺"){
                                $roudnessf="2";
                            }
                        }

                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeakmainaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    $audioc++;
                }elseif($audioc==1){
                    $roudnesssubaudio=$xmlData->RollFramework->AudioDescription->Loudness->{"Long-termLoudness"};
                    foreach ($xmlData->RollFramework->AudioDescription->Loudness->Annotation as $Annotation) {
                        
                        if($Annotation->AnnotationKind=="TruePeak"){
                            $truepeaksubaudio=$Annotation->AnnotationSynopsis;
                        }
                    }
                    
                }
            }
            

        }




         $blocknum=0;
         $block_start=[];
         $block_end=[];
         $block_dur=[];
         $block_obj=[];
         $block_source=[];
         $block_bik=[];

         foreach ($xmlData->RollFramework->Block as $Block) {
            $blocknum++;
            array_push($block_start, substr($Block->BlockStartPosition, 0, 8));
            array_push($block_end, substr($Block->BlockEndPosition, 0, 8));
            array_push($block_dur, substr($Block->BlockDuration, 0, 8));
            if($Block->BlockDescription->BlockKind=="PG"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="1"){
                            $block_obj_bl="0";
                        }else{
                            $block_obj_bl="9";
                        }
                        
                    }

                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="R-1"){
                            $block_source_bl="1";
                        }else if($BlockSubInfo->BlockValue=="R-2"){
                            $block_source_bl="4";
                        }else if($BlockSubInfo->BlockValue=="R-3"){
                            $block_source_bl="7";
                        }else if($BlockSubInfo->BlockValue=="R-4"){
                            $block_source_bl="10";
                        }else if($BlockSubInfo->BlockValue=="R-5"){
                            $block_source_bl="13";
                        }else if($BlockSubInfo->BlockValue=="R-5"){
                            $block_source_bl="13";
                        }else if($BlockSubInfo->BlockValue=="R-6"){
                            $block_source_bl="16";
                        }else if($BlockSubInfo->BlockValue=="R-7"){
                            $block_source_bl="19";
                        }else if($BlockSubInfo->BlockValue=="R-8"){
                            $block_source_bl="22";
                        }else if($BlockSubInfo->BlockValue=="R-9"){
                            $block_source_bl="25";
                        }else if($BlockSubInfo->BlockValue=="R-10"){
                            $block_source_bl="28";
                        }else if($BlockSubInfo->BlockValue=="R-11"){
                            $block_source_bl="31";
                        }else if($BlockSubInfo->BlockValue=="R-12"){
                            $block_source_bl="33";
                        }else if($BlockSubInfo->BlockValue=="R-13"){
                            $block_source_bl="35";
                        }else if($BlockSubInfo->BlockValue=="R-14"){
                            $block_source_bl="37";
                        }else if($BlockSubInfo->BlockValue=="R-15"){
                            $block_source_bl="39";
                        }else if($BlockSubInfo->BlockValue=="R-16"){
                            $block_source_bl="41";
                        }else if($BlockSubInfo->BlockValue=="R-17"){
                            $block_source_bl="42";
                        }else if($BlockSubInfo->BlockValue=="R-18"){
                            $block_source_bl="43";
                        }else if($BlockSubInfo->BlockValue=="R-19"){
                            $block_source_bl="44";
                        }else if($BlockSubInfo->BlockValue=="R-20"){
                            $block_source_bl="45";
                        }
                        
                    }
                }
            }else if($Block->BlockDescription->BlockKind=="CM"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="0"){
                            $block_obj_bl="1";
                        }else{
                            $block_obj_bl="7";
                        }
                        
                    }


                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="CM1"){
                            $block_source_bl="2";
                        }else if($BlockSubInfo->BlockValue=="CM2"){
                            $block_source_bl="5";
                        }else if($BlockSubInfo->BlockValue=="CM3"){
                            $block_source_bl="8";
                        }else if($BlockSubInfo->BlockValue=="CM4"){
                            $block_source_bl="11";
                        }else if($BlockSubInfo->BlockValue=="CM5"){
                            $block_source_bl="14";
                        }else if($BlockSubInfo->BlockValue=="CM6"){
                            $block_source_bl="17";
                        }else if($BlockSubInfo->BlockValue=="CM7"){
                            $block_source_bl="20";
                        }else if($BlockSubInfo->BlockValue=="CM8"){
                            $block_source_bl="23";
                        }else if($BlockSubInfo->BlockValue=="CM9"){
                            $block_source_bl="26";
                        }else if($BlockSubInfo->BlockValue=="CM10"){
                            $block_source_bl="29";
                        }else if($BlockSubInfo->BlockValue=="CM11"){
                            $block_source_bl="32";
                        }else if($BlockSubInfo->BlockValue=="CM12"){
                            $block_source_bl="34";
                        }else if($BlockSubInfo->BlockValue=="CM13"){
                            $block_source_bl="36";
                        }else if($BlockSubInfo->BlockValue=="CM14"){
                            $block_source_bl="38";
                        }else if($BlockSubInfo->BlockValue=="CM15"){
                            $block_source_bl="40";
                        }
                        
                    }


                }
            }else if($Block->BlockDescription->BlockKind=="SC"){
                foreach ($Block->BlockDescription->BlockSubInfo as $BlockSubInfo) {
                    if($BlockSubInfo->BlockSubKind=="BlockSignal"){
                        if($BlockSubInfo->BlockValue=="0"){
                            $block_obj_bl="2";
                        }else if($BlockSubInfo->BlockValue=="1"){
                            $block_obj_bl="4";
                        }else if($BlockSubInfo->BlockValue=="2"){
                            $block_obj_bl="5";
                        }else if($BlockSubInfo->BlockValue=="3"){
                            $block_obj_bl="6";
                        }
                        
                    }

                    if($BlockSubInfo->BlockSubKind=="BlockName"){
                        if($BlockSubInfo->BlockValue=="提供1"){
                            $block_source_bl="3";
                        }else if($BlockSubInfo->BlockValue=="提供2"){
                            $block_source_bl="6";
                        }else if($BlockSubInfo->BlockValue=="提供3"){
                            $block_source_bl="9";
                        }else if($BlockSubInfo->BlockValue=="提供4"){
                            $block_source_bl="12";
                        }else if($BlockSubInfo->BlockValue=="提供5"){
                            $block_source_bl="15";
                        }else if($BlockSubInfo->BlockValue=="提供6"){
                            $block_source_bl="18";
                        }else if($BlockSubInfo->BlockValue=="提供7"){
                            $block_source_bl="21";
                        }else if($BlockSubInfo->BlockValue=="提供8"){
                            $block_source_bl="24";
                        }else if($BlockSubInfo->BlockValue=="提供9"){
                            $block_source_bl="27";
                        }else if($BlockSubInfo->BlockValue=="提供10"){
                            $block_source_bl="30";
                        }
                        
                    }
                }
            }else if($Block->BlockDescription->BlockKind=="BB"){
                $block_obj_bl="3";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="NS"){
                $block_obj_bl="8";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="CB"){
                $block_obj_bl="10";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="CR"){
                $block_obj_bl="11";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="LC"){
                $block_obj_bl="12";
                $block_source_bl="0";
            }else if($Block->BlockDescription->BlockKind=="FC"){
                $block_obj_bl="13";
                $block_source_bl="0";
            }
            array_push($block_obj, $block_obj_bl);
            array_push($block_source, $block_source_bl);
            array_push($block_bik, $Block->BlockDescription->Annotation->AnnotationDescription);
         }



         $keynum=0;
         $key_start=[];
         $key_end=[];
         $key_dur=[];
         $key_shu=[];
         $key_nai=[];
         

         foreach ($xmlData->RollFramework->Keypoint as $Keypoint) {
            $keynum++;
            array_push($key_start, $Keypoint->KeypointPosition);
            array_push($key_end, $Keypoint->KeypointPosition);
            array_push($key_dur, $Keypoint->KeypointDuration);
            array_push($key_shu, $Keypoint->KeypointKind);
            array_push($key_nai, $Keypoint->KeypointValue);
         }
        

         
        $params=[
            'readfile'=>$fileName,
            'fileid'=>$fileid,
            'title'=>$title,
            'subtitle'=>$subtitle,
            'kaisuu'=>$kaisuu,

            'roll1'=>$roll1,
            'roll2'=>$roll2,

            'housoubi'=>$housoubi,
            'housoujikoku'=>$housoujikoku,

            'housoukyoku'=>$PublishingOrganizationName,

            'oaf'=>$oaf,
            


            'seisakunum'=>$seisakunum,
            'seisaku_shokushu'=>$seisaku_shokushu,
            'seisaku_sei'=>$seisaku_sei,
            'seisaku_mei'=>$seisaku_mei,
            'seisaku_kaisha'=>$seisaku_kaisha,
            'seisaku_renraku'=>$seisaku_renraku,


            'sagyounum'=>$sagyounum,
            'sagyou_sagyoubi'=>$sagyou_sagyoubi,
            'sagyou_naiyou'=>$sagyou_naiyou,
            'sagyou_sei'=>$sagyou_sei,
            'sagyou_mei'=>$sagyou_mei,
            'sagyou_kaisha'=>$sagyou_kaisha,
            'sagyou_renraku'=>$sagyou_renraku,
            'sagyou_shuroku'=>$sagyou_shuroku,


            'memo'=>$memo,
            'mediano'=>$mediano,

            'mediaformat'=>$mediaformat,
            'youtof'=>$youtof,
            'mediashubetuf'=>$mediashubetuf,
            'stopmarkf'=>$stopmarkf,

            'honkai'=>$honkai,
            'honzen'=>$honzen,

            'onseimodef'=>$onseimodef,
            'ch01f'=>$ch01f,
            'ch02f'=>$ch02f,
            'ch03f'=>$ch03f,
            'ch04f'=>$ch04f,
            'ch05f'=>$ch05f,
            'ch06f'=>$ch06f,
            'ch07f'=>$ch07f,
            'ch08f'=>$ch08f,
            'roudnessmainaudio'=>$roudnessmainaudio,
            'roudnessf'=>$roudnessf,
            'truepeakmainaudio'=>$truepeakmainaudio,
            'roudnesssubaudio'=>$roudnesssubaudio,
            'truepeaksubaudio'=>$truepeaksubaudio,
            'roudnesssanaudio'=>$roudnesssanaudio,
            'truepeaksanaudio'=>$truepeaksanaudio,





            'blocknum'=>$blocknum,
            'block_start'=>$block_start,
            'block_end'=>$block_end,
            'block_dur'=>$block_dur,
            'block_obj'=>$block_obj,
            'block_source'=>$block_source,
            'block_bik'=>$block_bik,

            'keynum'=>$keynum,
            'key_start'=>$key_start,
            'key_end'=>$key_end,
            'key_dur'=>$key_dur,
            'key_shu'=>$key_shu,
            'key_nai'=>$key_nai,
            
            
        ];
        return view('hello.exa',['items'=>$params]);






    }






    public function key(Request $request){
        $num=$request->id;



       // return view('hello.index',['blocks'=>$blocks]);
        return view('hello.key',['num'=>$num]);
    }

    public function sagyou(Request $request){
        $num=$request->id;



       // return view('hello.index',['blocks'=>$blocks]);
        return view('hello.sagyou',['num'=>$num]);
    }

    public function seisaku(Request $request){
        $num=$request->id;



       // return view('hello.index',['blocks'=>$blocks]);
        return view('hello.seisaku',['num'=>$num]);
    }


    public function edit(Request $request){
        /*
        $param=['id'=>$request->id];
        $item=DB::select('select * from people where id = :id',$param);
        */
        $items=DB::select('select * from people');
        return view('hello.edit',['form'=>$items]);
    }

    public function update(Request $request){
        /*
        $param=[
            'id'=>$request->id0,
            'name'=>$request->name0,
            'mail'=>$request->mail0,
            'age'=>$request->age0,
        ];
        DB::update('update people set name =:name,mail = :mail,
        age = :age where id =:id',$param);

        $param=[
            'id'=>$request->id1,
            'name'=>$request->name1,
            'mail'=>$request->mail1,
            'age'=>$request->age1,
        ];
        DB::update('update people set name =:name,mail = :mail,
        age = :age where id =:id',$param);
        return redirect('/hello');
        */

        


        /*

        $xml_text = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<items>
<title>{$request->name1}</title>
<url>https://www.sejuku.net/</url>
</items>
XML;
 
$test_xml = new \SimpleXMLElement($xml_text);
 
echo $test_xml->asXML("test2.xml"); // 出力ファイルのパスを記述


// ファイルのパス
$filepath = 'test2.xml';
 
// リネーム後のファイル名
$filename = 'test2.xml';
 
// ファイルタイプを指定→ここを省略！
 header('Content-Type: application/force-download');
 
// ファイルサイズを取得し、ダウンロードの進捗を表示→ここも省略！
header('Content-Length: '.filesize($filepath));
 
// ファイルのダウンロード、リネームを指示→attachmentを省略
header('Content-Disposition: attachment; filename="'.$filename.'"');
//header('Content-Disposition: filename="'.$filename.'"');
 
// ファイルを読み込みダウンロードを実行
readfile($filepath);
*/


if ($request->has('job')){


    $housoubi=substr($request->housoubi, 0, 4).'年'.substr($request->housoubi, 5, 2).'月'.substr($request->housoubi, 8, 2).'日';

    if($request->youtof=="0"){
        $youto="";
    }elseif($request->youtof=="1"){
        $youto="放送";
    }elseif($request->youtof=="2"){
        $youto="放送予備";
    }elseif($request->youtof=="3"){
        $youto="ネット";
    }elseif($request->youtof=="4"){
        $youto="保存";
    }elseif($request->youtof=="5"){
        $youto="裏送り";
    }elseif($request->youtof=="6"){
        $youto="番組管理";
    }elseif($request->youtof=="7"){
        $youto="素材";
    }elseif($request->youtof=="8"){
        $youto="素材予備";
    }elseif($request->youtof=="9"){
        $youto="その他";
    }

    if($request->mediashubetuf=="0"){
        $mediashubetu="";
    }elseif($request->mediashubetuf=="1"){
        $mediashubetu="XDCAM";
    }elseif($request->mediashubetuf=="2"){
        $mediashubetu="HDCAM";
    }elseif($request->mediashubetuf=="3"){
        $mediashubetu="HDCAM-SR";
    }


    if($request->oaf=="0"){
        $oa="";
    }elseif($request->oaf=="1"){
        $oa="地上波";
    }elseif($request->oaf=="2"){
        $oa="BS";
    }elseif($request->oaf=="3"){
        $oa="CS";
    }elseif($request->oaf=="4"){
        $oa="裏送り";
    }elseif($request->oaf=="5"){
        $oa="その他";
    }




    //$blocknum=0;
    $block_starth=[];
    $block_endh=[];
    $block_durh=[];
    $block_objh=[];
    $block_sourceh=[];
    $block_bikh=[];
    $blocknumh=[];

    $blocknum=(int)$request->blocknum;

    array_push($blocknumh, floor($blocknum / 10));
    array_push($blocknumh, $blocknum % 10);

    

    for ($i = 1; $i <= $blocknum; $i++) {
        $block_start="block_start".$i;
        array_push($block_starth, $request->$block_start);
        $block_end="block_end".$i;
        array_push($block_endh, $request->$block_end);
        $block_dur="block_dur".$i;
        array_push($block_durh, $request->$block_dur);
        $block_obj="block_obj".$i;
        array_push($block_objh, $request->$block_obj);
        $block_source="block_source".$i;
        array_push($block_sourceh, $request->$block_source);
        $block_bik="block_bik".$i;
        array_push($block_bikh, $request->$block_bik);
    }


    if($request->roudnessf=="0"){
        $roudness="";
    }elseif($request->roudnessf=="1"){
        $roudness="テープ毎";
    }elseif($request->roudnessf=="2"){
        $roudness="総尺";
    }



    if($request->onseimodef=="0"){
        $onseimode="";
    }elseif($request->onseimodef=="1"){
        $onseimode="ステレオ";
    }elseif($request->onseimodef=="2"){
        $onseimode="モノラル";
    }elseif($request->onseimodef=="3"){
        $onseimode="デュアルモノラル";
    }elseif($request->onseimodef=="4"){
        $onseimode="3モノラル";
    }elseif($request->onseimodef=="5"){
        $onseimode="デュアルステレオ";
    }elseif($request->onseimodef=="6"){
        $onseimode="5.1チャンネル";
    }elseif($request->onseimodef=="7"){
        $onseimode="5.1チャンネルステレオ+ステレオ";
    }


    if($request->ch01f=="0"){
        $ch01="";
    }elseif($request->ch01f=="1"){
        $ch01="L";
    }elseif($request->ch01f=="2"){
        $ch01="R";
    }elseif($request->ch01f=="3"){
        $ch01="MIX L";
    }elseif($request->ch01f=="4"){
        $ch01="MIX R";
    }elseif($request->ch01f=="5"){
        $ch01="MONO";
    }elseif($request->ch01f=="6"){
        $ch01="主音声";
    }elseif($request->ch01f=="7"){
        $ch01="副音声";
    }elseif($request->ch01f=="8"){
        $ch01="副音声1";
    }elseif($request->ch01f=="9"){
        $ch01="副音声2";
    }elseif($request->ch01f=="10"){
        $ch01="主音声L";
    }elseif($request->ch01f=="11"){
        $ch01="主音声R";
    }elseif($request->ch01f=="12"){
        $ch01="副音声L";
    }elseif($request->ch01f=="13"){
        $ch01="副音声R";
    }elseif($request->ch01f=="14"){
        $ch01="C";
    }elseif($request->ch01f=="15"){
        $ch01="LFE";
    }elseif($request->ch01f=="16"){
        $ch01="SL";
    }elseif($request->ch01f=="17"){
        $ch01="SR";
    }elseif($request->ch01f=="18"){
        $ch01="その他";
    }



    if($request->ch02f=="0"){
        $ch02="";
    }elseif($request->ch02f=="1"){
        $ch02="L";
    }elseif($request->ch02f=="2"){
        $ch02="R";
    }elseif($request->ch02f=="3"){
        $ch02="MIX L";
    }elseif($request->ch02f=="4"){
        $ch02="MIX R";
    }elseif($request->ch02f=="5"){
        $ch02="MONO";
    }elseif($request->ch02f=="6"){
        $ch02="主音声";
    }elseif($request->ch02f=="7"){
        $ch02="副音声";
    }elseif($request->ch02f=="8"){
        $ch02="副音声1";
    }elseif($request->ch02f=="9"){
        $ch02="副音声2";
    }elseif($request->ch02f=="10"){
        $ch02="主音声L";
    }elseif($request->ch02f=="11"){
        $ch02="主音声R";
    }elseif($request->ch02f=="12"){
        $ch02="副音声L";
    }elseif($request->ch02f=="13"){
        $ch02="副音声R";
    }elseif($request->ch02f=="14"){
        $ch02="C";
    }elseif($request->ch02f=="15"){
        $ch02="LFE";
    }elseif($request->ch02f=="16"){
        $ch02="SL";
    }elseif($request->ch02f=="17"){
        $ch02="SR";
    }elseif($request->ch02f=="18"){
        $ch02="その他";
    }


    if($request->ch03f=="0"){
        $ch03="";
    }elseif($request->ch03f=="1"){
        $ch03="L";
    }elseif($request->ch03f=="2"){
        $ch03="R";
    }elseif($request->ch03f=="3"){
        $ch03="MIX L";
    }elseif($request->ch03f=="4"){
        $ch03="MIX R";
    }elseif($request->ch03f=="5"){
        $ch03="MONO";
    }elseif($request->ch03f=="6"){
        $ch03="主音声";
    }elseif($request->ch03f=="7"){
        $ch03="副音声";
    }elseif($request->ch03f=="8"){
        $ch03="副音声1";
    }elseif($request->ch03f=="9"){
        $ch03="副音声2";
    }elseif($request->ch03f=="10"){
        $ch03="主音声L";
    }elseif($request->ch03f=="11"){
        $ch03="主音声R";
    }elseif($request->ch03f=="12"){
        $ch03="副音声L";
    }elseif($request->ch03f=="13"){
        $ch03="副音声R";
    }elseif($request->ch03f=="14"){
        $ch03="C";
    }elseif($request->ch03f=="15"){
        $ch03="LFE";
    }elseif($request->ch03f=="16"){
        $ch03="SL";
    }elseif($request->ch03f=="17"){
        $ch03="SR";
    }elseif($request->ch03f=="18"){
        $ch03="その他";
    }


    if($request->ch04f=="0"){
        $ch04="";
    }elseif($request->ch04f=="1"){
        $ch04="L";
    }elseif($request->ch04f=="2"){
        $ch04="R";
    }elseif($request->ch04f=="3"){
        $ch04="MIX L";
    }elseif($request->ch04f=="4"){
        $ch04="MIX R";
    }elseif($request->ch04f=="5"){
        $ch04="MONO";
    }elseif($request->ch04f=="6"){
        $ch04="主音声";
    }elseif($request->ch04f=="7"){
        $ch04="副音声";
    }elseif($request->ch04f=="8"){
        $ch04="副音声1";
    }elseif($request->ch04f=="9"){
        $ch04="副音声2";
    }elseif($request->ch04f=="10"){
        $ch04="主音声L";
    }elseif($request->ch04f=="11"){
        $ch04="主音声R";
    }elseif($request->ch04f=="12"){
        $ch04="副音声L";
    }elseif($request->ch04f=="13"){
        $ch04="副音声R";
    }elseif($request->ch04f=="14"){
        $ch04="C";
    }elseif($request->ch04f=="15"){
        $ch04="LFE";
    }elseif($request->ch04f=="16"){
        $ch04="SL";
    }elseif($request->ch04f=="17"){
        $ch04="SR";
    }elseif($request->ch04f=="18"){
        $ch04="その他";
    }



    if($request->ch05f=="0"){
        $ch05="";
    }elseif($request->ch05f=="1"){
        $ch05="L";
    }elseif($request->ch05f=="2"){
        $ch05="R";
    }elseif($request->ch05f=="3"){
        $ch05="MIX L";
    }elseif($request->ch05f=="4"){
        $ch05="MIX R";
    }elseif($request->ch05f=="5"){
        $ch05="MONO";
    }elseif($request->ch05f=="6"){
        $ch05="主音声";
    }elseif($request->ch05f=="7"){
        $ch05="副音声";
    }elseif($request->ch05f=="8"){
        $ch05="副音声1";
    }elseif($request->ch05f=="9"){
        $ch05="副音声2";
    }elseif($request->ch05f=="10"){
        $ch05="主音声L";
    }elseif($request->ch05f=="11"){
        $ch05="主音声R";
    }elseif($request->ch05f=="12"){
        $ch05="副音声L";
    }elseif($request->ch05f=="13"){
        $ch05="副音声R";
    }elseif($request->ch05f=="14"){
        $ch05="C";
    }elseif($request->ch05f=="15"){
        $ch05="LFE";
    }elseif($request->ch05f=="16"){
        $ch05="SL";
    }elseif($request->ch05f=="17"){
        $ch05="SR";
    }elseif($request->ch05f=="18"){
        $ch05="その他";
    }



    if($request->ch06f=="0"){
        $ch06="";
    }elseif($request->ch06f=="1"){
        $ch06="L";
    }elseif($request->ch06f=="2"){
        $ch06="R";
    }elseif($request->ch06f=="3"){
        $ch06="MIX L";
    }elseif($request->ch06f=="4"){
        $ch06="MIX R";
    }elseif($request->ch06f=="5"){
        $ch06="MONO";
    }elseif($request->ch06f=="6"){
        $ch06="主音声";
    }elseif($request->ch06f=="7"){
        $ch06="副音声";
    }elseif($request->ch06f=="8"){
        $ch06="副音声1";
    }elseif($request->ch06f=="9"){
        $ch06="副音声2";
    }elseif($request->ch06f=="10"){
        $ch06="主音声L";
    }elseif($request->ch06f=="11"){
        $ch06="主音声R";
    }elseif($request->ch06f=="12"){
        $ch06="副音声L";
    }elseif($request->ch06f=="13"){
        $ch06="副音声R";
    }elseif($request->ch06f=="14"){
        $ch06="C";
    }elseif($request->ch06f=="15"){
        $ch06="LFE";
    }elseif($request->ch06f=="16"){
        $ch06="SL";
    }elseif($request->ch06f=="17"){
        $ch06="SR";
    }elseif($request->ch06f=="18"){
        $ch06="その他";
    }




    if($request->ch07f=="0"){
        $ch07="";
    }elseif($request->ch07f=="1"){
        $ch07="L";
    }elseif($request->ch07f=="2"){
        $ch07="R";
    }elseif($request->ch07f=="3"){
        $ch07="MIX L";
    }elseif($request->ch07f=="4"){
        $ch07="MIX R";
    }elseif($request->ch07f=="5"){
        $ch07="MONO";
    }elseif($request->ch07f=="6"){
        $ch07="主音声";
    }elseif($request->ch07f=="7"){
        $ch07="副音声";
    }elseif($request->ch07f=="8"){
        $ch07="副音声1";
    }elseif($request->ch07f=="9"){
        $ch07="副音声2";
    }elseif($request->ch07f=="10"){
        $ch07="主音声L";
    }elseif($request->ch07f=="11"){
        $ch07="主音声R";
    }elseif($request->ch07f=="12"){
        $ch07="副音声L";
    }elseif($request->ch07f=="13"){
        $ch07="副音声R";
    }elseif($request->ch07f=="14"){
        $ch07="C";
    }elseif($request->ch07f=="15"){
        $ch07="LFE";
    }elseif($request->ch07f=="16"){
        $ch07="SL";
    }elseif($request->ch07f=="17"){
        $ch07="SR";
    }elseif($request->ch07f=="18"){
        $ch07="その他";
    }




    if($request->ch08f=="0"){
        $ch08="";
    }elseif($request->ch08f=="1"){
        $ch08="L";
    }elseif($request->ch08f=="2"){
        $ch08="R";
    }elseif($request->ch08f=="3"){
        $ch08="MIX L";
    }elseif($request->ch08f=="4"){
        $ch08="MIX R";
    }elseif($request->ch08f=="5"){
        $ch08="MONO";
    }elseif($request->ch08f=="6"){
        $ch08="主音声";
    }elseif($request->ch08f=="7"){
        $ch08="副音声";
    }elseif($request->ch08f=="8"){
        $ch08="副音声1";
    }elseif($request->ch08f=="9"){
        $ch08="副音声2";
    }elseif($request->ch08f=="10"){
        $ch08="主音声L";
    }elseif($request->ch08f=="11"){
        $ch08="主音声R";
    }elseif($request->ch08f=="12"){
        $ch08="副音声L";
    }elseif($request->ch08f=="13"){
        $ch08="副音声R";
    }elseif($request->ch08f=="14"){
        $ch08="C";
    }elseif($request->ch08f=="15"){
        $ch08="LFE";
    }elseif($request->ch08f=="16"){
        $ch08="SL";
    }elseif($request->ch08f=="17"){
        $ch08="SR";
    }elseif($request->ch08f=="18"){
        $ch08="その他";
    }




    $sagyounum=(int)$request->sagyounum;
    $sagyou_sagyoubih=[];
    $sagyou_naiyouh=[];
    $sagyou_seih=[];
    $sagyou_meih=[];
    $sagyou_nameh=[];
    $sagyou_kaishah=[];
    $sagyou_renrakuh=[];
    $sagyou_shurokuh=[];

    for ($i = 1; $i <= $sagyounum; $i++) {
        $sagyou_sagyoubi="sagyou_sagyoubi".$i;
        array_push($sagyou_sagyoubih, $request->$sagyou_sagyoubi);
        $sagyou_naiyou="sagyou_naiyou".$i;
        array_push($sagyou_naiyouh, $request->$sagyou_naiyou);
        $sagyou_sei="sagyou_sei".$i;
        $sagyou_mei="sagyou_mei".$i;
        array_push($sagyou_nameh, $request->$sagyou_sei.$request->$sagyou_mei);
        $sagyou_kaisha="sagyou_kaisha".$i;
        array_push($sagyou_kaishah, $request->$sagyou_kaisha);
        $sagyou_renraku="sagyou_renraku".$i;
        array_push($sagyou_renrakuh, $request->$sagyou_renraku);
    }









    $seisakunum=(int)$request->seisakunum;
    $seisaku_shokushuh=[];
    $seisaku_seih=[];
    $seisaku_meih=[];
    $seisaku_nameh=[];
    $seisaku_kaishah=[];
    $seisaku_renrakuh=[];


    for ($i = 1; $i <= $seisakunum; $i++) {
        $seisaku_shokushu="seisaku_shokushu".$i;
        array_push($seisaku_shokushuh, $request->$seisaku_shokushu);
        $seisaku_sei="seisaku_sei".$i;
        $seisaku_mei="seisaku_mei".$i;
        array_push($seisaku_nameh, $request->$seisaku_sei.$request->$seisaku_mei);
        $seisaku_kaisha="seisaku_kaisha".$i;
        array_push($seisaku_kaishah, $request->$seisaku_kaisha);
        $seisaku_renraku="seisaku_renraku".$i;
        array_push($seisaku_renrakuh, $request->$seisaku_renraku);
    }
        
    










    $params=[
        'today'=>date("Y/m/d"),
        'title'=>$request->title,
        'mediano'=>$request->mediano,
        'housoubi'=>$housoubi,
        'subtitle'=>$request->subtitle,
        'wasuu'=>$request->wasuu,
        'roll'=>$request->roll1.'/'.$request->roll2,
        'youto'=>$youto,
        'honkai'=>$request->honkai,
        'honzen'=>$request->honzen,
        'eizou'=>$request->eizou,
        'mediashubetu'=>$mediashubetu,
        'mediaformat'=>$request->mediaformat,
        'oa'=>$oa,

        'blocknum'=>$blocknum,
        'block_start'=>$block_starth,
        'block_end'=>$block_endh,
        'block_dur'=>$block_durh,
        'block_obj'=>$block_objh,
        'block_source'=>$block_sourceh,
        'block_bik'=>$block_bikh,
        'blocknumh'=>$blocknumh,

        'housoukyoku'=>$request->housoukyoku,
        'roudness'=>$roudness,
        'onseimode'=>$onseimode,
        'ch01'=>$ch01,
        'ch02'=>$ch02,
        'ch03'=>$ch03,
        'ch04'=>$ch04,
        'ch05'=>$ch05,
        'ch06'=>$ch06,
        'ch07'=>$ch07,
        'ch08'=>$ch08,

        'roudnessmainaudio'=>$request->roudnessmainaudio,
        'truepeakmainaudio'=>$request->truepeakmainaudio,
        'roudnesssubaudio'=>$request->roudnesssubaudio,
        'truepeaksubaudio'=>$request->truepeaksubaudio,
        'roudnesssanaudio'=>$request->roudnesssanaudio,
        'truepeaksanaudio'=>$request->truepeaksanaudio,

        'fileid'=>$request->fileid,
        'memo'=>$request->memo,
        

        'sagyounum'=>$sagyounum,
        'sagyou_sagyoubi'=>$sagyou_sagyoubih,
        'sagyou_naiyou'=>$sagyou_naiyouh,
        'sagyou_name'=>$sagyou_nameh,
        'sagyou_kaisha'=>$sagyou_kaishah,
        'sagyou_renraku'=>$sagyou_renrakuh,

        'seisakunum'=>$seisakunum,
        'seisaku_shokushu'=>$seisaku_shokushuh,
        'seisaku_name'=>$seisaku_nameh,
        'seisaku_kaisha'=>$seisaku_kaishah,
        'seisaku_renraku'=>$seisaku_renrakuh,
        
    ];

        $pdf = \PDF::loadView('hello.show',['items'=>$params]);

        $filename=$request->fileid;

        return $pdf->download('PEM_'.$filename.'.pdf');
        








///////////////////////////////////////読み込み処理/////////////////////////////////////
}else if($request->has('read')){
    $file = $request->file('file');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        $xmlData = simplexml_load_file($xml);//xmlを読み込む



        $fileid=substr($fileName, 4, -4);  

        $title=$xmlData->ProgramFramework->Titles->MainTitle;
        $subtitle=$xmlData->ProgramFramework->Titles->SecondaryTitle;

        foreach ($xmlData->ProgramFramework->GroupRelationship as $GroupRelationship) {
            if($GroupRelationship->ProgrammingGroupTitle=="回数"){
                $kaisuu=$GroupRelationship->NumericalPositionInSequence;
            }

            if($GroupRelationship->ProgrammingGroupTitle=="ロール番号"){
                $roll=$GroupRelationship->NumericalPositionInSequence;
            }

         }
        

        $roll1=substr($roll, 0, 2);
        if(substr($roll1, 0, 1)=="0"){
            $roll1=substr($roll1, 1, 1);
        }

        $roll2=substr($roll, 2, 3);
        if(substr($roll2, 0, 2)=="00"){
            $roll2=substr($roll2, 2, 1);
        }elseif(substr($roll2, 0, 1)=="0"){
            $roll2=substr($roll2, 3, 2);
        }

        $EventStartDateandTime=$xmlData->ProgramFramework->Event->EventStartDateandTime;

        $housoubi=substr($EventStartDateandTime, 0, 10);
        $housoujikoku=substr($EventStartDateandTime, 11, 8);

        $PublishingOrganizationName=$xmlData->ProgramFramework->Event->Publication->PublishingOrganizationName;

        $PublishingMediumName=$xmlData->ProgramFramework->Event->Publication->PublishingMediumName;

        if($PublishingMediumName==""){
            $oaf="0";
        }elseif($PublishingMediumName=="地上波"){
            $oaf="1";
        }elseif($PublishingMediumName=="BS"){
            $oaf="2";
        }elseif($PublishingMediumName=="CS"){
            $oaf="3";
        }elseif($PublishingMediumName=="裏送り"){
            $oaf="4";
        }elseif($PublishingMediumName=="その他"){
            $oaf="5";
        }

        


        $seisakunum=0;
        $seisaku_shokushu=[];
        $seisaku_sei=[];
        $seisaku_mei=[];
        $seisaku_kaisha=[];
        $seisaku_renraku=[];
        
        $sagyounum=0;
        $sagyou_sagyoubi=[];
        $sagyou_naiyou=[];
        $sagyou_sei=[];
        $sagyou_mei=[];
        $sagyou_kaisha=[];
        $sagyou_renraku=[];
        $sagyou_shuroku=[];

        foreach ($xmlData->ProgramFramework->Participant as $Participant) {
            if($Participant->JobFunction=="CP"){
                $seisakunum++;
                array_push($seisaku_shokushu, $Participant->ContributionStatus);
                array_push($seisaku_sei, $Participant->Person->FamilyName);
                array_push($seisaku_mei, $Participant->Person->FirstGivenName);
                array_push($seisaku_kaisha, $Participant->Person->Organization->OrganizationMainName);
                array_push($seisaku_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
            }

            if($Participant->JobFunction=="PP"){
                $sagyounum++;
                array_push($sagyou_sagyoubi, substr($Participant->ContributionDate, 0, 10));
               array_push($sagyou_naiyou, $Participant->ContributionStatus);
               array_push($sagyou_sei, $Participant->Person->FamilyName);
               array_push($sagyou_mei, $Participant->Person->FirstGivenName);
               array_push($sagyou_kaisha, $Participant->Person->Organization->OrganizationMainName);
               array_push($sagyou_renraku, $Participant->Person->Organization->Address->Communications->TelephoneNumber);
               array_push($sagyou_shuroku, $Participant->Annotation->AnnotationDescription);
            }

         }



         $memo=$xmlData->ProgramFramework->Annotation->AnnotationDescription;

        $mediano=$xmlData->RollFramework->Identification->IdentifierValue;



        foreach ($xmlData->RollFramework->Annotation as $Annotation) {
            if($Annotation->AnnotationKind=="Format"){
                $mediaformat=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="Purpose"){
                $youto=$Annotation->AnnotationSynopsis;
            }elseif($Annotation->AnnotationKind=="MediaKind"){
                $mediashubetu=$Annotation->AnnotationDescription;
            }elseif($Annotation->AnnotationKind=="StopCode"){
                $stopmark=$Annotation->AnnotationDescription;
            }

         }


         if($youto==""){
             $youtof="0";
         }elseif($youto=="放送"){
            $youtof="1";
         }elseif($youto=="放送予備"){
            $youtof="2";
         }elseif($youto=="ネット"){
            $youtof="3";
         }elseif($youto=="保存"){
            $youtof="4";
         }elseif($youto=="裏送り"){
            $youtof="5";
         }elseif($youto=="番組管理"){
            $youtof="6";
         }elseif($youto=="素材"){
            $youtof="7";
         }elseif($youto=="素材予備"){
            $youtof="8";
         }elseif($youto=="その他"){
            $youtof="9";
         }else{
            $youtof="";
         }


         if($mediashubetu==""){
             $mediashubetuf="0";
         }elseif($mediashubetu=="XDCAM"){
            $mediashubetuf="1";
         }elseif($mediashubetu=="HDCAM"){
            $mediashubetuf="2";
         }elseif($mediashubetu=="HDCAM-SR"){
            $mediashubetuf="3";
         }else{
            $mediashubetuf="";
         }


        if($stopmark==""){
            $stopmarkf="0";
        }elseif($stopmark=="ストップマーク無し"){
            $stopmarkf="1";
        }elseif($stopmark=="ストップマーク有り"){
            $stopmarkf="2";
        }else{
            $stopmarkf="";
        }



        $honkai=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->EntryPoint;

        $honkai=substr($honkai, 0, 8);

        $honzen=$xmlData->RollFramework->VideoDescription->FileDescription->TimeCodeInfo->TotalDuration;

        $honzen=substr($honzen, 0, 8);




        $ElectrospatialFormulation=$xmlData->RollFramework->AudioDescription->ElectrospatialFormulation;

        if($ElectrospatialFormulation==""){
            $onseimodef="0";
        }elseif($ElectrospatialFormulation=="1"){
            $onseimodef="1";
        }




         $blocknum=0;
         $block_start=[];
         $block_end=[];
         $block_dur=[];
         $block_obj=[];
         $block_source=[];
         $block_bik=[];

         foreach ($xmlData->RollFramework->Block as $Block) {
            $blocknum++;
            array_push($block_start, substr($Block->BlockStartPosition, 0, 8));
            array_push($block_end, substr($Block->BlockEndPosition, 0, 8));
            array_push($block_dur, substr($Block->BlockDuration, 0, 8));
            array_push($block_obj, $Block->BlockDescription->BlockKind);
            array_push($block_source, $Block->BlockDescription->BlockSubInfo->BlockValue);
            array_push($block_bik, $Block->BlockDescription->Annotation->AnnotationDescription);
         }



         $keynum=0;
         $key_start=[];
         $key_end=[];
         $key_dur=[];
         $key_shu=[];
         $key_nai=[];
         

         foreach ($xmlData->RollFramework->Keypoint as $Keypoint) {
            $keynum++;
            array_push($key_start, $Keypoint->KeypointPosition);
            array_push($key_end, $Keypoint->KeypointPosition);
            array_push($key_dur, $Keypoint->KeypointDuration);
            array_push($key_shu, $Keypoint->KeypointKind);
            array_push($key_nai, $Keypoint->KeypointValue);
         }
        

         
        $params=[
            'readfile'=>$fileName,
            'fileid'=>$fileid,
            'title'=>$title,
            'subtitle'=>$subtitle,
            'kaisuu'=>$kaisuu,

            'roll1'=>$roll1,
            'roll2'=>$roll2,

            'housoubi'=>$housoubi,
            'housoujikoku'=>$housoujikoku,

            'housoukyoku'=>$PublishingOrganizationName,

            'oaf'=>$oaf,
            


            'seisakunum'=>$seisakunum,
            'seisaku_shokushu'=>$seisaku_shokushu,
            'seisaku_sei'=>$seisaku_sei,
            'seisaku_mei'=>$seisaku_mei,
            'seisaku_kaisha'=>$seisaku_kaisha,
            'seisaku_renraku'=>$seisaku_renraku,


            'sagyounum'=>$sagyounum,
            'sagyou_sagyoubi'=>$sagyou_sagyoubi,
            'sagyou_naiyou'=>$sagyou_naiyou,
            'sagyou_sei'=>$sagyou_sei,
            'sagyou_mei'=>$sagyou_mei,
            'sagyou_kaisha'=>$sagyou_kaisha,
            'sagyou_renraku'=>$sagyou_renraku,
            'sagyou_shuroku'=>$sagyou_shuroku,


            'memo'=>$memo,
            'mediano'=>$mediano,

            'mediaformat'=>$mediaformat,
            'youtof'=>$youtof,
            'mediashubetuf'=>$mediashubetuf,
            'stopmarkf'=>$stopmarkf,

            'honkai'=>$honkai,
            'honzen'=>$honzen,

            'onseimodef'=>$onseimodef,




            'blocknum'=>$blocknum,
            'block_start'=>$block_start,
            'block_end'=>$block_end,
            'block_dur'=>$block_dur,
            'block_obj'=>$block_obj,
            'block_source'=>$block_source,
            'block_bik'=>$block_bik,

            'keynum'=>$keynum,
            'key_start'=>$key_start,
            'key_end'=>$key_end,
            'key_dur'=>$key_dur,
            'key_shu'=>$key_shu,
            'key_nai'=>$key_nai,
            
            
        ];
        return view('hello.exa',['items'=>$params]);










///////////////////////////////////////メタデータ作成///////////////////////////////////////


}else{

        //Domを生成
$dom = new \DomDocument('1.0', 'utf-16');
$dom->formatOutput = true; 
 
//親要素を定義
$Pem_main = $dom->appendChild($dom->createElement('Pem_main')); 

$xmlns = $dom->createAttribute('xmlns');
// Value for the created attribute
$xmlns->value = "http://www.arib.or.jp/trb31/schemas/2010/PEM";
// Don't forget to append it to the element
$Pem_main->appendChild($xmlns);

$xmlns_xsi = $dom->createAttribute('xmlns:xsi');
// Value for the created attribute
$xmlns_xsi->value = "http://www.w3.org/2001/XMLSchema-instance";
// Don't forget to append it to the element
$Pem_main->appendChild($xmlns_xsi);

$version = $dom->createAttribute('version');
// Value for the created attribute
$version->value = "1.3";
// Don't forget to append it to the element
$Pem_main->appendChild($version);

$date=substr(date("y/m/d H:i:s"), 0, 2).substr(date("y/m/d H:i:s"), 3, 2).substr(date("y/m/d H:i:s"), 6, 2).substr(date("y/m/d H:i:s"), 9, 2).substr(date("y/m/d H:i:s"), 12, 2).substr(date("y/m/d H:i:s"), 15, 2);

$MetadataId = $Pem_main->appendChild($dom->createElement('MetadataId',"ytv_".$date."{$request->fileid}")); 
$MetadataVersion = $Pem_main->appendChild($dom->createElement('MetadataVersion',"21")); 
$ProgramFramework = $Pem_main->appendChild($dom->createElement('ProgramFramework')); 

//data2の子要素を定義
//要素１
$Titles = $ProgramFramework->appendChild($dom->createElement('Titles')); 
$Titles->appendChild($dom->createElement('MainTitle', $request->title)); 
$Titles->appendChild($dom->createElement('SecondaryTitle', $request->subtitle));

//要素２
$Identification = $ProgramFramework->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentificationKind', 'ProgramId')); 
$Identification->appendChild($dom->createElement('IdentificationValue'));
$Identification->appendChild($dom->createElement('IdentificationIssuingAuthority'));

//要素３
$GroupRelationship = $ProgramFramework->appendChild($dom->createElement('GroupRelationship')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupKind', 'Lower')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupTitle', '回数'));
$GroupRelationship->appendChild($dom->createElement('NumericalPositionInSequence', $request->wasuu));

$roll="";
if(strlen($request->roll1)==1){
    if(strlen($request->roll2)==1){
        $roll="0".$request->roll1."00".$request->roll2;
    }else if(strlen($request->roll2)==2){
        $roll="0".$request->roll1."0".$request->roll2;
    }else if(strlen($request->roll2)==3){
        $roll="0".$request->roll1.$request->roll2;
    }
    
}else if(strlen($request->roll1)==2){
    if(strlen($request->roll2)==1){
        $roll=$request->roll1."00".$request->roll2;
    }else if(strlen($request->roll2)==2){
        $roll=$request->roll1."0".$request->roll2;
    }else if(strlen($request->roll2)==3){
        $roll=$request->roll1.$request->roll2;
    }
    
    
}


//要素４
$GroupRelationship = $ProgramFramework->appendChild($dom->createElement('GroupRelationship')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupKind', 'Other')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupTitle', 'ロール番号'));
$GroupRelationship->appendChild($dom->createElement('NumericalPositionInSequence', $roll));

$Event = $ProgramFramework->appendChild($dom->createElement('Event')); 
$Event->appendChild($dom->createElement('EventIndication', 'Schedule')); 
$Event->appendChild($dom->createElement('EventStartDateandTime', $request->housoubi."T".$request->housoujikoku));
$Event->appendChild($dom->createElement('EventEndDateandTime'));

$Publication = $Event->appendChild($dom->createElement('Publication')); 
$Publication->appendChild($dom->createElement('PublishingOrganizationName', $request->housoukyoku)); 

if($request->oaf==0){
    $oaf="";
}else if($request->oaf==1){
    $oaf="地上波";
}else if($request->oaf==2){
    $oaf="BS";
}else if($request->oaf==3){
    $oaf="CS";
}else if($request->oaf==4){
    $oaf="裏送り";
}else if($request->oaf==5){
    $oaf="その他";
}

$Publication->appendChild($dom->createElement('PublishingMediumName', $oaf)); 

$Identification = $Event->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentificationKind')); 
$Identification->appendChild($dom->createElement('IdentificationValue')); 
$Identification->appendChild($dom->createElement('IdentificationIssuingAuthority')); 

$num01 = (int) $request->seisakunum;
for ($i = 1; $i <= $num01; $i++) {
    $Participant = $ProgramFramework->appendChild($dom->createElement('Participant')); 
    $Participant->appendChild($dom->createElement('JobFunction', 'CP')); 
    $Participant->appendChild($dom->createElement('ContributionDate'));
    $seisaku_shokushu="seisaku_shokushu".$i;
    $Participant->appendChild($dom->createElement('ContributionStatus',$request->$seisaku_shokushu));
    $Participant->appendChild($dom->createElement('ContributionLocation'));

    $Person = $Participant->appendChild($dom->createElement('Person')); 
    $seisaku_sei="seisaku_sei".$i;
    $Person->appendChild($dom->createElement('FamilyName',$request->$seisaku_sei)); 
    $seisaku_mei="seisaku_mei".$i;
    $Person->appendChild($dom->createElement('FirstGivenName',$request->$seisaku_mei)); 

    $Organization = $Person->appendChild($dom->createElement('Organization')); 
    $seisaku_kaisha="seisaku_kaisha".$i;
    $Organization->appendChild($dom->createElement('OrganizationMainName',$request->$seisaku_kaisha));

    $Address = $Organization->appendChild($dom->createElement('Address')); 

    $Communications = $Address->appendChild($dom->createElement('Communications'));
    $seisaku_renraku="seisaku_renraku".$i;
    $Communications->appendChild($dom->createElement('TelephoneNumber',$request->$seisaku_renraku)); 

    $Annotation = $Participant->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind')); 
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis')); 
    $Annotation->appendChild($dom->createElement('AnnotationDescription')); 

}


$num02 = (int) $request->sagyounum;
for ($i = 1; $i <= $num02; $i++) {
    $Participant = $ProgramFramework->appendChild($dom->createElement('Participant')); 
    $Participant->appendChild($dom->createElement('JobFunction', 'PP')); 
    $sagyou_sagyoubi="sagyou_sagyoubi".$i;
    $Participant->appendChild($dom->createElement('ContributionDate',$request->$sagyou_sagyoubi."T00:00:00"));
    $sagyou_naiyou="sagyou_naiyou".$i;
    if($request->$sagyou_naiyou==0){
        $ContributionStatus="REC";
    }else if($request->$sagyou_naiyou==1){
        $ContributionStatus="PB";
    }else if($request->$sagyou_naiyou==2){
        $ContributionStatus="DUB";
    }else if($request->$sagyou_naiyou==3){
        $ContributionStatus="ED";
    }else if($request->$sagyou_naiyou==4){
        $ContributionStatus="ING";
    }else if($request->$sagyou_naiyou==5){
        $ContributionStatus="MA";
    }else if($request->$sagyou_naiyou==6){
        $ContributionStatus="PV";
    }else if($request->$sagyou_naiyou==7){
        $ContributionStatus="OA";
    }else if($request->$sagyou_naiyou==8){
        $ContributionStatus="(OA)";
    }else if($request->$sagyou_naiyou==9){
        $ContributionStatus="ERA";
    }else if($request->$sagyou_naiyou==10){
        $ContributionStatus="Meta";
    }else if($request->$sagyou_naiyou==11){
        $ContributionStatus="その他";
    }


    $Participant->appendChild($dom->createElement('ContributionStatus',$ContributionStatus));
    $Participant->appendChild($dom->createElement('ContributionLocation'));

    $Person = $Participant->appendChild($dom->createElement('Person')); 
    $sagyou_sei="sagyou_sei".$i;
    $Person->appendChild($dom->createElement('FamilyName',$request->$sagyou_sei)); 
    $sagyou_mei="sagyou_mei".$i;
    $Person->appendChild($dom->createElement('FirstGivenName',$request->$sagyou_mei)); 

    $Organization = $Person->appendChild($dom->createElement('Organization')); 
    $sagyou_kaisha="sagyou_kaisha".$i;
    $Organization->appendChild($dom->createElement('OrganizationMainName',$request->$sagyou_kaisha));

    $Address = $Organization->appendChild($dom->createElement('Address')); 

    $Communications = $Address->appendChild($dom->createElement('Communications'));
    $sagyou_renraku="sagyou_renraku".$i;
    $Communications->appendChild($dom->createElement('TelephoneNumber',$request->$sagyou_renraku)); 

    $Annotation = $Participant->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind')); 
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis')); 
    $sagyou_shuroku="sagyou_shuroku".$i;
    $Annotation->appendChild($dom->createElement('AnnotationDescription',$request->$sagyou_shuroku)); 

}


$PlayList = $ProgramFramework->appendChild($dom->createElement('PlayList')); 
$PlayList->appendChild($dom->createElement('RollTotalCount', '1'));

$RollList = $PlayList->appendChild($dom->createElement('RollList'));
$Roll = $RollList->appendChild($dom->createElement('Roll'));

$Number = $dom->createAttribute('Number');
// Value for the created attribute
$Number->value = "1";
// Don't forget to append it to the element
$Roll->appendChild($Number);

$Roll->appendChild($dom->createElement('ID','ABCDEFGHIJ123456789'));


$Annotation = $ProgramFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'PogramMemo'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$request->memo));



$RollFramework = $Pem_main->appendChild($dom->createElement('RollFramework')); 

$Identification = $RollFramework->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentifierKind', 'MediaId'));
$Identification->appendChild($dom->createElement('IdentifierValue',$request->mediano));
$Identification->appendChild($dom->createElement('IdenticationIssuingAuthority'));

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'Format'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$request->mediaformat));

if($request->youtof==0){
    $AnnotationSynopsis="";
}else if($request->youtof==1){
    $AnnotationSynopsis="放送";
}else if($request->youtof==2){
    $AnnotationSynopsis="放送予備";
}else if($request->youtof==3){
    $AnnotationSynopsis="ネット";
}else if($request->youtof==4){
    $AnnotationSynopsis="保存";
}else if($request->youtof==5){
    $AnnotationSynopsis="裏送り";
}else if($request->youtof==6){
    $AnnotationSynopsis="番組管理";
}else if($request->youtof==7){
    $AnnotationSynopsis="素材";
}else if($request->youtof==8){
    $AnnotationSynopsis="素材予備";
}else if($request->youtof==9){
    $AnnotationSynopsis="やり繰り";
}else if($request->youtof==10){
    $AnnotationSynopsis="その他";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'Purpose'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis',$AnnotationSynopsis));


if($request->mediashubetuf==0){
    $AnnotationDescription="";
}else if($request->mediashubetuf==1){
    $AnnotationDescription="XDCAM";
}else if($request->mediashubetuf==2){
    $AnnotationDescription="HDCAM";
}else if($request->mediashubetuf==3){
    $AnnotationDescription="HDCAM-SR";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'MediaKind'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$AnnotationDescription));

if($request->stopmarkf==0){
    $AnnotationDescription="";
}else if($request->stopmarkf==1){
    $AnnotationDescription="ストップマーク無し";
}else if($request->stopmarkf==2){
    $AnnotationDescription="ストップマーク有り";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'StopCode'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$AnnotationDescription));

$VideoDescription = $RollFramework->appendChild($dom->createElement('VideoDescription')); 
$VideoDescription->appendChild($dom->createElement('ImageFormat', $request->eizou));

$FileDescription = $VideoDescription->appendChild($dom->createElement('FileDescription')); 
$Identification = $FileDescription->appendChild($dom->createElement('Identification')); 
$Identification ->appendChild($dom->createElement('IdentifierKind'));
$Identification ->appendChild($dom->createElement('IdentifierValue'));
$Identification ->appendChild($dom->createElement('IdenticationIssuingAuthority'));

$TimeCodeInfo = $FileDescription->appendChild($dom->createElement('TimeCodeInfo')); 
$TimeCodeInfo ->appendChild($dom->createElement('CountMode','DF'));
$TimeCodeInfo ->appendChild($dom->createElement('EntryPoint',$request->honkai.":00"));
$TimeCodeInfo ->appendChild($dom->createElement('TotalDuration',$request->honzen.":00"));
$TimeCodeInfo ->appendChild($dom->createElement('PlayoutDuration'));
$TimeCodeInfo ->appendChild($dom->createElement('TimeCodeUnit'));


if($request->onseimodef=="1"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '1'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="2"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '0'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="3"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '2'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="4"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '3'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "3";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssanaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksanaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="5"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '4'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "4";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="6"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '6'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "6";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "5";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch05f==0){
        $ChannelAssignment="";
    }else if($request->ch05f==1){
        $ChannelAssignment="L";
    }else if($request->ch05f==2){
        $ChannelAssignment="R";
    }else if($request->ch05f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch05f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch05f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch05f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch05f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch05f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch05f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch05f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch05f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch05f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch05f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch05f==14){
        $ChannelAssignment="C";
    }else if($request->ch05f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch05f==16){
        $ChannelAssignment="SL";
    }else if($request->ch05f==17){
        $ChannelAssignment="SR";
    }else if($request->ch05f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "6";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch06f==0){
        $ChannelAssignment="";
    }else if($request->ch06f==1){
        $ChannelAssignment="L";
    }else if($request->ch06f==2){
        $ChannelAssignment="R";
    }else if($request->ch06f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch06f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch06f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch06f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch06f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch06f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch06f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch06f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch06f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch06f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch06f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch06f==14){
        $ChannelAssignment="C";
    }else if($request->ch06f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch06f==16){
        $ChannelAssignment="SL";
    }else if($request->ch06f==17){
        $ChannelAssignment="SR";
    }else if($request->ch06f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));




    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="7"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '8'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "8";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "5";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch05f==0){
        $ChannelAssignment="";
    }else if($request->ch05f==1){
        $ChannelAssignment="L";
    }else if($request->ch05f==2){
        $ChannelAssignment="R";
    }else if($request->ch05f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch05f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch05f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch05f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch05f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch05f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch05f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch05f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch05f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch05f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch05f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch05f==14){
        $ChannelAssignment="C";
    }else if($request->ch05f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch05f==16){
        $ChannelAssignment="SL";
    }else if($request->ch05f==17){
        $ChannelAssignment="SR";
    }else if($request->ch05f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "6";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch06f==0){
        $ChannelAssignment="";
    }else if($request->ch06f==1){
        $ChannelAssignment="L";
    }else if($request->ch06f==2){
        $ChannelAssignment="R";
    }else if($request->ch06f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch06f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch06f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch06f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch06f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch06f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch06f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch06f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch06f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch06f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch06f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch06f==14){
        $ChannelAssignment="C";
    }else if($request->ch06f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch06f==16){
        $ChannelAssignment="SL";
    }else if($request->ch06f==17){
        $ChannelAssignment="SR";
    }else if($request->ch06f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "7";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch07f==0){
        $ChannelAssignment="";
    }else if($request->ch07f==1){
        $ChannelAssignment="L";
    }else if($request->ch07f==2){
        $ChannelAssignment="R";
    }else if($request->ch07f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch07f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch07f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch07f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch07f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch07f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch07f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch07f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch07f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch07f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch07f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch07f==14){
        $ChannelAssignment="C";
    }else if($request->ch07f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch07f==16){
        $ChannelAssignment="SL";
    }else if($request->ch07f==17){
        $ChannelAssignment="SR";
    }else if($request->ch07f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "8";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch08f==0){
        $ChannelAssignment="";
    }else if($request->ch08f==1){
        $ChannelAssignment="L";
    }else if($request->ch08f==2){
        $ChannelAssignment="R";
    }else if($request->ch08f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch08f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch08f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch08f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch08f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch08f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch08f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch08f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch08f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch08f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch08f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch08f==14){
        $ChannelAssignment="C";
    }else if($request->ch08f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch08f==16){
        $ChannelAssignment="SL";
    }else if($request->ch08f==17){
        $ChannelAssignment="SR";
    }else if($request->ch08f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));




    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}



$num03 = (int) $request->blocknum;
for ($i = 1; $i < $num03; $i++) {
    $Block = $RollFramework->appendChild($dom->createElement('Block')); 
    $BlockNumber = $dom->createAttribute('BlockNumber');
    // Value for the created attribute
    $BlockNumber->value = $i;
    // Don't forget to append it to the element
    $Block->appendChild($BlockNumber);

    $BlockTotalCount = $dom->createAttribute('BlockTotalCount');
    // Value for the created attribute
    $BlockTotalCount->value = $num03-1;
    // Don't forget to append it to the element
    $Block->appendChild($BlockTotalCount);

    $block_start="block_start".$i;
    $Block->appendChild($dom->createElement('BlockStartPosition', $request->$block_start.":00"));
    $block_end="block_end".$i;
    $Block->appendChild($dom->createElement('BlockEndPosition', $request->$block_end.":00"));
    $block_dur="block_dur".$i;
    $Block->appendChild($dom->createElement('BlockDuration', $request->$block_dur.":00"));

    $BlockDescription = $Block->appendChild($dom->createElement('BlockDescription')); 


    $block_source="block_source".$i;
    if($request->$block_source==0){
        $BlockValue="";
    }else if($request->$block_source==1){
        $BlockValue="R-1";
    }else if($request->$block_source==2){
        $BlockValue="CM1";
    }else if($request->$block_source==3){
        $BlockValue="提供1";
    }else if($request->$block_source==4){
        $BlockValue="R-2";
    }else if($request->$block_source==5){
        $BlockValue="CM2";
    }else if($request->$block_source==6){
        $BlockValue="提供2";
    }else if($request->$block_source==7){
        $BlockValue="R-3";
    }else if($request->$block_source==8){
        $BlockValue="CM3";
    }else if($request->$block_source==9){
        $BlockValue="提供3";
    }else if($request->$block_source==10){
        $BlockValue="R-4";
    }else if($request->$block_source==11){
        $BlockValue="CM4";
    }else if($request->$block_source==12){
        $BlockValue="提供4";
    }else if($request->$block_source==13){
        $BlockValue="R-5";
    }else if($request->$block_source==14){
        $BlockValue="CM5";
    }else if($request->$block_source==15){
        $BlockValue="提供5";
    }else if($request->$block_source==16){
        $BlockValue="R-6";
    }else if($request->$block_source==17){
        $BlockValue="CM6";
    }else if($request->$block_source==18){
        $BlockValue="提供6";
    }else if($request->$block_source==19){
        $BlockValue="R-7";
    }else if($request->$block_source==20){
        $BlockValue="CM7";
    }else if($request->$block_source==21){
        $BlockValue="提供7";
    }else if($request->$block_source==22){
        $BlockValue="R-8";
    }else if($request->$block_source==23){
        $BlockValue="CM8";
    }else if($request->$block_source==24){
        $BlockValue="提供8";
    }else if($request->$block_source==25){
        $BlockValue="R-9";
    }else if($request->$block_source==26){
        $BlockValue="CM9";
    }else if($request->$block_source==27){
        $BlockValue="提供9";
    }else if($request->$block_source==28){
        $BlockValue="R-10";
    }else if($request->$block_source==29){
        $BlockValue="CM10";
    }else if($request->$block_source==30){
        $BlockValue="提供10";
    }else if($request->$block_source==31){
        $BlockValue="R-11";
    }else if($request->$block_source==30){
        $BlockValue="CM11";
    }else if($request->$block_source==33){
        $BlockValue="R-12";
    }else if($request->$block_source==34){
        $BlockValue="CM12";
    }else if($request->$block_source==35){
        $BlockValue="R-13";
    }else if($request->$block_source==36){
        $BlockValue="CM13";
    }else if($request->$block_source==37){
        $BlockValue="R-14";
    }else if($request->$block_source==38){
        $BlockValue="CM14";
    }else if($request->$block_source==39){
        $BlockValue="R-15";
    }else if($request->$block_source==40){
        $BlockValue="CM15";
    }else if($request->$block_source==41){
        $BlockValue="R-16";
    }else if($request->$block_source==42){
        $BlockValue="R-17";
    }else if($request->$block_source==43){
        $BlockValue="R-18";
    }else if($request->$block_source==44){
        $BlockValue="R-19";
    }else if($request->$block_source==45){
        $BlockValue="R-20";
    }



    $block_obj="block_obj".$i;
    if($request->$block_obj==0){
        $BlockKind="PG";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==1){
        $BlockKind="CM";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==2){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==3){
        $BlockKind="BB";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==4){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==5){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="2";
    }else if($request->$block_obj==6){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="3";
    }else if($request->$block_obj==7){
        $BlockKind="CM";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==8){
        $BlockKind="NS";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==9){
        $BlockKind="PG";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==10){
        $BlockKind="CB";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==11){
        $BlockKind="CR";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==12){
        $BlockKind="LC";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==13){
        $BlockKind="FC";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==14){
        $BlockKind="END";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==15){
        $BlockKind="";
        $BlockSubNumber="";
        $BlockValue1="";
    }
    $BlockDescription->appendChild($dom->createElement('BlockKind', $BlockKind));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubNumber',$BlockSubNumber));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubKind','BlockName'));
    $BlockSubInfo->appendChild($dom->createElement('BlockValue',$BlockValue));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubKind','BlockSignal'));
    $BlockSubInfo->appendChild($dom->createElement('BlockValue',$BlockValue1));

    $block_bik="block_bik".$i;

    $Annotation = $BlockDescription->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind','BlockMemo'));
    $Annotation->appendChild($dom->createElement('AnnotationDescription',$request->$block_bik));
}

$num04 = (int) $request->keynum;
for ($i = 1; $i <= $num04; $i++) {
    $Keypoint = $RollFramework->appendChild($dom->createElement('Keypoint')); 
    $key_shu="key_shu".$i;
    $Keypoint->appendChild($dom->createElement('KeypointKind', $request->$key_shu));
    $key_start="key_start".$i;
    $Keypoint->appendChild($dom->createElement('KeypointPosition', $request->$key_start.":00"));
    $key_dur="key_dur".$i;
    $Keypoint->appendChild($dom->createElement('KeypointDuration', $request->$key_dur.":00"));
    $key_nai="key_nai".$i;
    $Keypoint->appendChild($dom->createElement('KeypointValue', $request->$key_nai));

}


//XML出力
$fileName = 'PEM_'.$request->fileid.'.xml';
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename='.$fileName);
echo $dom->saveXML();


    
    



}






    }

    public function create(Request $request){
        $params=[
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
        ];
        DB::insert('insert into people (name,mail,age) values (:name,:mail,:age)',$params);
        return redirect('/hello');
    }

    public function del(Request $request){
        $param=['id'=>$request->id];
        $item=DB::select('select * from people where id = :id',$param);
        return view('hello.del',['form'=>$item[0]]);
    }

    public function cmcreate(Request $request){
         //Domを生成
$dom = new \DomDocument('1.0', 'shift-jis');
$dom->formatOutput = true; 
 
//親要素を定義
$CM_meta_data = $dom->appendChild($dom->createElement('CM_meta_data')); 

$xmlns_xsi = $dom->createAttribute('xmlns:xsi');
// Value for the created attribute
$xmlns_xsi->value = "http://www.w3.org/2001/XMLSchema-instance";
// Don't forget to append it to the element
$CM_meta_data->appendChild($xmlns_xsi);

$xsi_shemaLocation = $dom->createAttribute('xsi:schemaLocation');
// Value for the created attribute
$xsi_shemaLocation->value = "http://www.nab.or.jp/TVCMMeta/schema/v100 TVCMMeta_v100.xsd";
// Don't forget to append it to the element
$CM_meta_data->appendChild($xsi_shemaLocation);

$xmlns = $dom->createAttribute('xmlns');
// Value for the created attribute
$xmlns->value = "http://www.nab.or.jp/TVCMMeta/schema/v100";
// Don't forget to append it to the element
$CM_meta_data->appendChild($xmlns);

$cm_code_advertiser_id = $CM_meta_data->appendChild($dom->createElement('cm_code_advertiser_id',$request->cmcode1)); 
$cm_code_material_id = $CM_meta_data->appendChild($dom->createElement('cm_code_material_id',$request->cmcode2)); 
$CM_name = $CM_meta_data->appendChild($dom->createElement('CM_name',$request->cmsozai)); 
$CM_original_name = $CM_meta_data->appendChild($dom->createElement('CM_original_name',$request->cmsakuhin)); 
$product_name = $CM_meta_data->appendChild($dom->createElement('product_name',$request->cmshouhinmei)); 
$CM_sponsor_name = $CM_meta_data->appendChild($dom->createElement('CM_sponsor_name',$request->cmsozaikoukoku)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $request->cmcode1;
// Don't forget to append it to the element
$CM_sponsor_name->appendChild($code);

$production_ADcompany_name = $CM_meta_data->appendChild($dom->createElement('production_ADcompany_name',$request->cmkoukokumei)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $request->cmkoukokucode;
// Don't forget to append it to the element
$production_ADcompany_name->appendChild($code);


$production_company_name = $CM_meta_data->appendChild($dom->createElement('production_company_name',$request->cmseisakumei)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $request->cmseisakucode;
// Don't forget to append it to the element
$production_company_name->appendChild($code);


$CM_duration = $CM_meta_data->appendChild($dom->createElement('CM_duration',$request->cmsozaitime));

if($request->cmbaitaif=="0"){
    $media_type="";
    $media_type_code="";
}elseif($request->cmbaitaif=="1"){
    $media_type="XDCAM";
    $media_type_code="15";
}else{
    $media_type="P2";
    $media_type_code="16";
}
$media_type = $CM_meta_data->appendChild($dom->createElement('media_type',$media_type)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $media_type_code;
// Don't forget to append it to the element
$media_type->appendChild($code);


if($request->cmdff=="0"){
    $TC_count_mode="";
    $TC_count_mode_code="";
}elseif($request->cmdff=="1"){
    $TC_count_mode="DF";
    $TC_count_mode_code="1";
}else{
    $TC_count_mode="NDF";
    $TC_count_mode_code="2";
}
$TC_count_mode = $CM_meta_data->appendChild($dom->createElement('TC_count_mode',$TC_count_mode));

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $TC_count_mode_code;
// Don't forget to append it to the element
$TC_count_mode->appendChild($code);


if($request->cmeizouf=="0"){
    $video_definition_mode="";
    $video_definition_mode_code="";
}elseif($request->cmeizouf=="1"){
    $video_definition_mode="HD";
    $video_definition_mode_code="1";
}else{
    $video_definition_mode="SD";
    $video_definition_mode_code="2";
}
$video_definition_mode = $CM_meta_data->appendChild($dom->createElement('video_definition_mode','HD')); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $video_definition_mode_code;
// Don't forget to append it to the element
$video_definition_mode->appendChild($code);


if($request->cmgakakuf=="0"){
    $video_aspect_ratio="";
    $video_aspect_ratio_code="";
}elseif($request->cmgakakuf=="1"){
    $video_aspect_ratio="４：３";
    $video_aspect_ratio_code="1";
}else{
    $video_aspect_ratio="１６：９";
    $video_aspect_ratio_code="2";
}
$video_aspect_ratio = $CM_meta_data->appendChild($dom->createElement('video_aspect_ratio',$video_aspect_ratio)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $video_aspect_ratio_code;
// Don't forget to append it to the element
$video_aspect_ratio->appendChild($code);


if($request->cmonseimodef=="0"){
    $audio_format="";
    $audio_format_code="";
}elseif($request->cmonseimodef=="1"){
    $audio_format="モノラル";
    $audio_format_code="1";
}elseif($request->cmonseimodef=="2"){
    $audio_format="ステレオ";
    $audio_format_code="2";
}else{
    $audio_format="5.1+S";
    $audio_format_code="3";
}
$audio_format = $CM_meta_data->appendChild($dom->createElement('audio_format',$audio_format)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $audio_format_code;
// Don't forget to append it to the element
$audio_format->appendChild($code);

$start_timecode=substr($request->cmkaishiTC, 0, 2).substr($request->cmkaishiTC, 3, 2).substr($request->cmkaishiTC, 6, 2)."00";

$start_timecode = $CM_meta_data->appendChild($dom->createElement('start_timecode',$start_timecode)); 


if($request->cmjimakuf=="0"){
    $CM_caption_existence="";
    $CM_caption_existence_code="";
}elseif($request->cmjimakuf=="1"){
    $CM_caption_existence="無し";
    $CM_caption_existence_code="1";
}else{
    $CM_caption_existence="有り";
    $CM_caption_existence_code="2";
}
$CM_caption_existence = $CM_meta_data->appendChild($dom->createElement('CM_caption_existence',$CM_caption_existence)); 

$code = $dom->createAttribute('code');
// Value for the created attribute
$code->value = $CM_caption_existence_code;
// Don't forget to append it to the element
$CM_caption_existence->appendChild($code);

$registered_time=substr(date("Y/m/d H:i:s"), 0, 4).substr(date("Y/m/d H:i:s"), 5, 2).substr(date("Y/m/d H:i:s"), 8, 2).substr(date("Y/m/d H:i:s"), 11, 2).substr(date("Y/m/d H:i:s"), 14, 2).substr(date("Y/m/d H:i:s"), 17, 2);

$update_time=substr(date("Y/m/d H:i:s"), 0, 4).substr(date("Y/m/d H:i:s"), 5, 2).substr(date("Y/m/d H:i:s"), 8, 2).substr(date("Y/m/d H:i:s"), 11, 2).substr(date("Y/m/d H:i:s"), 14, 2).substr(date("Y/m/d H:i:s"), 17, 2);

$registered_time = $CM_meta_data->appendChild($dom->createElement('registered_time',$registered_time));
$update_time = $CM_meta_data->appendChild($dom->createElement('update_time',$update_time));


$remarks_column = $CM_meta_data->appendChild($dom->createElement('remarks_column',$request->cmbikou));

$memo = $CM_meta_data->appendChild($dom->createElement('memo'));
$memo->appendChild($dom->createElement('user_area_1',$request->cmuser1));
$memo->appendChild($dom->createElement('user_area_2',$request->cmuser2));
$memo->appendChild($dom->createElement('user_area_3',$request->cmroudness));

$version = $CM_meta_data->appendChild($dom->createElement('version'));

$cm_meta_version_number=substr($request->metaver, 0, 1).substr($request->metaver, 2, 1).substr($request->metaver, 4, 1);
$version->appendChild($dom->createElement('cm_meta_version_number',$cm_meta_version_number));

//XML出力
$fileName = 'CM_'.$request->cmcode1.$request->cmcode2.'.xml';
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename='.$fileName);
echo $dom->saveXML();

    }

    public function remove(Request $request){
          //Domを生成
$dom = new \DomDocument('1.0', 'utf-16');
$dom->formatOutput = true; 
 
//親要素を定義
$Pem_main = $dom->appendChild($dom->createElement('Pem_main')); 

$xmlns = $dom->createAttribute('xmlns');
// Value for the created attribute
$xmlns->value = "http://www.arib.or.jp/trb31/schemas/2010/PEM";
// Don't forget to append it to the element
$Pem_main->appendChild($xmlns);

$xmlns_xsi = $dom->createAttribute('xmlns:xsi');
// Value for the created attribute
$xmlns_xsi->value = "http://www.w3.org/2001/XMLSchema-instance";
// Don't forget to append it to the element
$Pem_main->appendChild($xmlns_xsi);

$version = $dom->createAttribute('version');
// Value for the created attribute
$version->value = "1.3";
// Don't forget to append it to the element
$Pem_main->appendChild($version);

$date=substr(date("y/m/d H:i:s"), 0, 2).substr(date("y/m/d H:i:s"), 3, 2).substr(date("y/m/d H:i:s"), 6, 2).substr(date("y/m/d H:i:s"), 9, 2).substr(date("y/m/d H:i:s"), 12, 2).substr(date("y/m/d H:i:s"), 15, 2);

$MetadataId = $Pem_main->appendChild($dom->createElement('MetadataId',"ytv_".$date."{$request->fileid}")); 
$MetadataVersion = $Pem_main->appendChild($dom->createElement('MetadataVersion',"21")); 
$ProgramFramework = $Pem_main->appendChild($dom->createElement('ProgramFramework')); 

//data2の子要素を定義
//要素１
$Titles = $ProgramFramework->appendChild($dom->createElement('Titles')); 
$Titles->appendChild($dom->createElement('MainTitle', $request->title)); 
$Titles->appendChild($dom->createElement('SecondaryTitle', $request->subtitle));

//要素２
$Identification = $ProgramFramework->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentificationKind', 'ProgramId')); 
$Identification->appendChild($dom->createElement('IdentificationValue'));
$Identification->appendChild($dom->createElement('IdentificationIssuingAuthority'));

//要素３
$GroupRelationship = $ProgramFramework->appendChild($dom->createElement('GroupRelationship')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupKind', 'Lower')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupTitle', '回数'));
$GroupRelationship->appendChild($dom->createElement('NumericalPositionInSequence', $request->wasuu));

$roll="";
if(strlen($request->roll1)==1){
    if(strlen($request->roll2)==1){
        $roll="0".$request->roll1."00".$request->roll2;
    }else if(strlen($request->roll2)==2){
        $roll="0".$request->roll1."0".$request->roll2;
    }else if(strlen($request->roll2)==3){
        $roll="0".$request->roll1.$request->roll2;
    }
    
}else if(strlen($request->roll1)==2){
    if(strlen($request->roll2)==1){
        $roll=$request->roll1."00".$request->roll2;
    }else if(strlen($request->roll2)==2){
        $roll=$request->roll1."0".$request->roll2;
    }else if(strlen($request->roll2)==3){
        $roll=$request->roll1.$request->roll2;
    }
    
    
}


//要素４
$GroupRelationship = $ProgramFramework->appendChild($dom->createElement('GroupRelationship')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupKind', 'Other')); 
$GroupRelationship->appendChild($dom->createElement('ProgrammingGroupTitle', 'ロール番号'));
$GroupRelationship->appendChild($dom->createElement('NumericalPositionInSequence', $roll));

$Event = $ProgramFramework->appendChild($dom->createElement('Event')); 
$Event->appendChild($dom->createElement('EventIndication', 'Schedule')); 
$Event->appendChild($dom->createElement('EventStartDateandTime', $request->housoubi."T".$request->housoujikoku));
$Event->appendChild($dom->createElement('EventEndDateandTime'));

$Publication = $Event->appendChild($dom->createElement('Publication')); 
$Publication->appendChild($dom->createElement('PublishingOrganizationName', $request->housoukyoku)); 

if($request->oaf==0){
    $oaf="";
}else if($request->oaf==1){
    $oaf="地上波";
}else if($request->oaf==2){
    $oaf="BS";
}else if($request->oaf==3){
    $oaf="CS";
}else if($request->oaf==4){
    $oaf="裏送り";
}else if($request->oaf==5){
    $oaf="その他";
}

$Publication->appendChild($dom->createElement('PublishingMediumName', $oaf)); 

$Identification = $Event->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentificationKind')); 
$Identification->appendChild($dom->createElement('IdentificationValue')); 
$Identification->appendChild($dom->createElement('IdentificationIssuingAuthority')); 

$num01 = (int) $request->seisakunum;
for ($i = 1; $i <= $num01; $i++) {
    $Participant = $ProgramFramework->appendChild($dom->createElement('Participant')); 
    $Participant->appendChild($dom->createElement('JobFunction', 'CP')); 
    $Participant->appendChild($dom->createElement('ContributionDate'));
    $seisaku_shokushu="seisaku_shokushu".$i;
    $Participant->appendChild($dom->createElement('ContributionStatus',$request->$seisaku_shokushu));
    $Participant->appendChild($dom->createElement('ContributionLocation'));

    $Person = $Participant->appendChild($dom->createElement('Person')); 
    $seisaku_sei="seisaku_sei".$i;
    $Person->appendChild($dom->createElement('FamilyName',$request->$seisaku_sei)); 
    $seisaku_mei="seisaku_mei".$i;
    $Person->appendChild($dom->createElement('FirstGivenName',$request->$seisaku_mei)); 

    $Organization = $Person->appendChild($dom->createElement('Organization')); 
    $seisaku_kaisha="seisaku_kaisha".$i;
    $Organization->appendChild($dom->createElement('OrganizationMainName',$request->$seisaku_kaisha));

    $Address = $Organization->appendChild($dom->createElement('Address')); 

    $Communications = $Address->appendChild($dom->createElement('Communications'));
    $seisaku_renraku="seisaku_renraku".$i;
    $Communications->appendChild($dom->createElement('TelephoneNumber',$request->$seisaku_renraku)); 

    $Annotation = $Participant->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind')); 
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis')); 
    $Annotation->appendChild($dom->createElement('AnnotationDescription')); 

}


$num02 = (int) $request->sagyounum;
for ($i = 1; $i <= $num02; $i++) {
    $Participant = $ProgramFramework->appendChild($dom->createElement('Participant')); 
    $Participant->appendChild($dom->createElement('JobFunction', 'PP')); 
    $sagyou_sagyoubi="sagyou_sagyoubi".$i;
    $Participant->appendChild($dom->createElement('ContributionDate',$request->$sagyou_sagyoubi."T00:00:00"));
    $sagyou_naiyou="sagyou_naiyou".$i;
    if($request->$sagyou_naiyou==0){
        $ContributionStatus="REC";
    }else if($request->$sagyou_naiyou==1){
        $ContributionStatus="PB";
    }else if($request->$sagyou_naiyou==2){
        $ContributionStatus="DUB";
    }else if($request->$sagyou_naiyou==3){
        $ContributionStatus="ED";
    }else if($request->$sagyou_naiyou==4){
        $ContributionStatus="ING";
    }else if($request->$sagyou_naiyou==5){
        $ContributionStatus="MA";
    }else if($request->$sagyou_naiyou==6){
        $ContributionStatus="PV";
    }else if($request->$sagyou_naiyou==7){
        $ContributionStatus="OA";
    }else if($request->$sagyou_naiyou==8){
        $ContributionStatus="(OA)";
    }else if($request->$sagyou_naiyou==9){
        $ContributionStatus="ERA";
    }else if($request->$sagyou_naiyou==10){
        $ContributionStatus="Meta";
    }else if($request->$sagyou_naiyou==11){
        $ContributionStatus="その他";
    }


    $Participant->appendChild($dom->createElement('ContributionStatus',$ContributionStatus));
    $Participant->appendChild($dom->createElement('ContributionLocation'));

    $Person = $Participant->appendChild($dom->createElement('Person')); 
    $sagyou_sei="sagyou_sei".$i;
    $Person->appendChild($dom->createElement('FamilyName',$request->$sagyou_sei)); 
    $sagyou_mei="sagyou_mei".$i;
    $Person->appendChild($dom->createElement('FirstGivenName',$request->$sagyou_mei)); 

    $Organization = $Person->appendChild($dom->createElement('Organization')); 
    $sagyou_kaisha="sagyou_kaisha".$i;
    $Organization->appendChild($dom->createElement('OrganizationMainName',$request->$sagyou_kaisha));

    $Address = $Organization->appendChild($dom->createElement('Address')); 

    $Communications = $Address->appendChild($dom->createElement('Communications'));
    $sagyou_renraku="sagyou_renraku".$i;
    $Communications->appendChild($dom->createElement('TelephoneNumber',$request->$sagyou_renraku)); 

    $Annotation = $Participant->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind')); 
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis')); 
    $sagyou_shuroku="sagyou_shuroku".$i;
    $Annotation->appendChild($dom->createElement('AnnotationDescription',$request->$sagyou_shuroku)); 

}


$PlayList = $ProgramFramework->appendChild($dom->createElement('PlayList')); 
$PlayList->appendChild($dom->createElement('RollTotalCount', '1'));

$RollList = $PlayList->appendChild($dom->createElement('RollList'));
$Roll = $RollList->appendChild($dom->createElement('Roll'));

$Number = $dom->createAttribute('Number');
// Value for the created attribute
$Number->value = "1";
// Don't forget to append it to the element
$Roll->appendChild($Number);

$Roll->appendChild($dom->createElement('ID','ABCDEFGHIJ123456789'));


$Annotation = $ProgramFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'PogramMemo'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$request->memo));



$RollFramework = $Pem_main->appendChild($dom->createElement('RollFramework')); 

$Identification = $RollFramework->appendChild($dom->createElement('Identification')); 
$Identification->appendChild($dom->createElement('IdentifierKind', 'MediaId'));
$Identification->appendChild($dom->createElement('IdentifierValue',$request->mediano));
$Identification->appendChild($dom->createElement('IdenticationIssuingAuthority'));

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'Format'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$request->mediaformat));

if($request->youtof==0){
    $AnnotationSynopsis="";
}else if($request->youtof==1){
    $AnnotationSynopsis="放送";
}else if($request->youtof==2){
    $AnnotationSynopsis="放送予備";
}else if($request->youtof==3){
    $AnnotationSynopsis="ネット";
}else if($request->youtof==4){
    $AnnotationSynopsis="保存";
}else if($request->youtof==5){
    $AnnotationSynopsis="裏送り";
}else if($request->youtof==6){
    $AnnotationSynopsis="番組管理";
}else if($request->youtof==7){
    $AnnotationSynopsis="素材";
}else if($request->youtof==8){
    $AnnotationSynopsis="素材予備";
}else if($request->youtof==9){
    $AnnotationSynopsis="やり繰り";
}else if($request->youtof==10){
    $AnnotationSynopsis="その他";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'Purpose'));
$Annotation->appendChild($dom->createElement('AnnotationSynopsis',$AnnotationSynopsis));


if($request->mediashubetuf==0){
    $AnnotationDescription="";
}else if($request->mediashubetuf==1){
    $AnnotationDescription="XDCAM";
}else if($request->mediashubetuf==2){
    $AnnotationDescription="HDCAM";
}else if($request->mediashubetuf==3){
    $AnnotationDescription="HDCAM-SR";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'MediaKind'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$AnnotationDescription));

if($request->stopmarkf==0){
    $AnnotationDescription="";
}else if($request->stopmarkf==1){
    $AnnotationDescription="ストップマーク無し";
}else if($request->stopmarkf==2){
    $AnnotationDescription="ストップマーク有り";
}

$Annotation = $RollFramework->appendChild($dom->createElement('Annotation')); 
$Annotation->appendChild($dom->createElement('AnnotationKind', 'StopCode'));
$Annotation->appendChild($dom->createElement('AnnotationDescription',$AnnotationDescription));

$VideoDescription = $RollFramework->appendChild($dom->createElement('VideoDescription')); 
$VideoDescription->appendChild($dom->createElement('ImageFormat', $request->eizou));

$FileDescription = $VideoDescription->appendChild($dom->createElement('FileDescription')); 
$Identification = $FileDescription->appendChild($dom->createElement('Identification')); 
$Identification ->appendChild($dom->createElement('IdentifierKind'));
$Identification ->appendChild($dom->createElement('IdentifierValue'));
$Identification ->appendChild($dom->createElement('IdenticationIssuingAuthority'));

$TimeCodeInfo = $FileDescription->appendChild($dom->createElement('TimeCodeInfo')); 
$TimeCodeInfo ->appendChild($dom->createElement('CountMode','DF'));
$TimeCodeInfo ->appendChild($dom->createElement('EntryPoint',$request->honkai.":00"));
$TimeCodeInfo ->appendChild($dom->createElement('TotalDuration',$request->honzen.":00"));
$TimeCodeInfo ->appendChild($dom->createElement('PlayoutDuration'));
$TimeCodeInfo ->appendChild($dom->createElement('TimeCodeUnit'));


if($request->onseimodef=="1"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '1'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="2"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '0'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="3"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '2'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "2";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="4"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '3'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "3";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssanaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksanaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="5"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '4'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "4";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));



    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="6"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '6'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "6";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "5";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch05f==0){
        $ChannelAssignment="";
    }else if($request->ch05f==1){
        $ChannelAssignment="L";
    }else if($request->ch05f==2){
        $ChannelAssignment="R";
    }else if($request->ch05f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch05f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch05f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch05f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch05f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch05f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch05f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch05f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch05f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch05f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch05f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch05f==14){
        $ChannelAssignment="C";
    }else if($request->ch05f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch05f==16){
        $ChannelAssignment="SL";
    }else if($request->ch05f==17){
        $ChannelAssignment="SR";
    }else if($request->ch05f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "6";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch06f==0){
        $ChannelAssignment="";
    }else if($request->ch06f==1){
        $ChannelAssignment="L";
    }else if($request->ch06f==2){
        $ChannelAssignment="R";
    }else if($request->ch06f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch06f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch06f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch06f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch06f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch06f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch06f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch06f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch06f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch06f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch06f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch06f==14){
        $ChannelAssignment="C";
    }else if($request->ch06f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch06f==16){
        $ChannelAssignment="SL";
    }else if($request->ch06f==17){
        $ChannelAssignment="SR";
    }else if($request->ch06f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));




    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}elseif($request->onseimodef=="7"){
    $AudioDescription = $RollFramework->appendChild($dom->createElement('AudioDescription')); 
    $AudioDescription->appendChild($dom->createElement('ElectrospatialFormulation', '8'));
    $ChannelList = $AudioDescription->appendChild($dom->createElement('ChannelList'));

    $ChannelCount = $dom->createAttribute('ChannelCount');
    // Value for the created attribute
    $ChannelCount->value = "8";
    // Don't forget to append it to the element
    $ChannelList->appendChild($ChannelCount);

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "1";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch01f==0){
        $ChannelAssignment="";
    }else if($request->ch01f==1){
        $ChannelAssignment="L";
    }else if($request->ch01f==2){
        $ChannelAssignment="R";
    }else if($request->ch01f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch01f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch01f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch01f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch01f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch01f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch01f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch01f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch01f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch01f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch01f==14){
        $ChannelAssignment="C";
    }else if($request->ch01f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch01f==16){
        $ChannelAssignment="SL";
    }else if($request->ch01f==17){
        $ChannelAssignment="SR";
    }else if($request->ch01f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));

    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "2";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch02f==0){
        $ChannelAssignment="";
    }else if($request->ch02f==1){
        $ChannelAssignment="L";
    }else if($request->ch02f==2){
        $ChannelAssignment="R";
    }else if($request->ch02f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch02f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch02f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch02f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch02f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch02f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch01f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch02f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch02f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch02f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch02f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch02f==14){
        $ChannelAssignment="C";
    }else if($request->ch02f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch02f==16){
        $ChannelAssignment="SL";
    }else if($request->ch02f==17){
        $ChannelAssignment="SR";
    }else if($request->ch02f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "3";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch03f==0){
        $ChannelAssignment="";
    }else if($request->ch03f==1){
        $ChannelAssignment="L";
    }else if($request->ch03f==2){
        $ChannelAssignment="R";
    }else if($request->ch03f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch03f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch03f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch03f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch03f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch03f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch03f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch03f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch03f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch03f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch03f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch03f==14){
        $ChannelAssignment="C";
    }else if($request->ch03f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch03f==16){
        $ChannelAssignment="SL";
    }else if($request->ch03f==17){
        $ChannelAssignment="SR";
    }else if($request->ch03f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "4";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch04f==0){
        $ChannelAssignment="";
    }else if($request->ch04f==1){
        $ChannelAssignment="L";
    }else if($request->ch04f==2){
        $ChannelAssignment="R";
    }else if($request->ch04f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch04f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch04f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch04f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch04f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch04f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch04f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch04f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch04f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch04f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch04f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch04f==14){
        $ChannelAssignment="C";
    }else if($request->ch04f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch04f==16){
        $ChannelAssignment="SL";
    }else if($request->ch04f==17){
        $ChannelAssignment="SR";
    }else if($request->ch04f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "5";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch05f==0){
        $ChannelAssignment="";
    }else if($request->ch05f==1){
        $ChannelAssignment="L";
    }else if($request->ch05f==2){
        $ChannelAssignment="R";
    }else if($request->ch05f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch05f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch05f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch05f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch05f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch05f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch05f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch05f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch05f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch05f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch05f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch05f==14){
        $ChannelAssignment="C";
    }else if($request->ch05f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch05f==16){
        $ChannelAssignment="SL";
    }else if($request->ch05f==17){
        $ChannelAssignment="SR";
    }else if($request->ch05f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));


    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "6";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch06f==0){
        $ChannelAssignment="";
    }else if($request->ch06f==1){
        $ChannelAssignment="L";
    }else if($request->ch06f==2){
        $ChannelAssignment="R";
    }else if($request->ch06f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch06f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch06f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch06f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch06f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch06f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch06f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch06f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch06f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch06f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch06f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch06f==14){
        $ChannelAssignment="C";
    }else if($request->ch06f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch06f==16){
        $ChannelAssignment="SL";
    }else if($request->ch06f==17){
        $ChannelAssignment="SR";
    }else if($request->ch06f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "7";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch07f==0){
        $ChannelAssignment="";
    }else if($request->ch07f==1){
        $ChannelAssignment="L";
    }else if($request->ch07f==2){
        $ChannelAssignment="R";
    }else if($request->ch07f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch07f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch07f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch07f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch07f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch07f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch07f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch07f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch07f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch07f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch07f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch07f==14){
        $ChannelAssignment="C";
    }else if($request->ch07f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch07f==16){
        $ChannelAssignment="SL";
    }else if($request->ch07f==17){
        $ChannelAssignment="SR";
    }else if($request->ch07f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));



    $ChannelObject = $ChannelList->appendChild($dom->createElement('ChannelObject'));

    $ChannelNumber = $dom->createAttribute('ChannelNumber');
    // Value for the created attribute
    $ChannelNumber->value = "8";
    // Don't forget to append it to the element
    $ChannelObject->appendChild($ChannelNumber);

    if($request->ch08f==0){
        $ChannelAssignment="";
    }else if($request->ch08f==1){
        $ChannelAssignment="L";
    }else if($request->ch08f==2){
        $ChannelAssignment="R";
    }else if($request->ch08f==3){
        $ChannelAssignment="MIX L";
    }else if($request->ch08f==4){
        $ChannelAssignment="MIX R";
    }else if($request->ch08f==5){
        $ChannelAssignment="MONO";
    }else if($request->ch08f==6){
        $ChannelAssignment="主音声";
    }else if($request->ch08f==7){
        $ChannelAssignment="副音声";
    }else if($request->ch08f==8){
        $ChannelAssignment="副音声1";
    }else if($request->ch08f==9){
        $ChannelAssignment="副音声2";
    }else if($request->ch08f==10){
        $ChannelAssignment="主音声L";
    }else if($request->ch08f==11){
        $ChannelAssignment="主音声R";
    }else if($request->ch08f==12){
        $ChannelAssignment="副音声L";
    }else if($request->ch08f==13){
        $ChannelAssignment="副音声R";
    }else if($request->ch08f==14){
        $ChannelAssignment="C";
    }else if($request->ch08f==15){
        $ChannelAssignment="LFE";
    }else if($request->ch08f==16){
        $ChannelAssignment="SL";
    }else if($request->ch08f==17){
        $ChannelAssignment="SR";
    }else if($request->ch08f==18){
        $ChannelAssignment="その他";
    }

    $ChannelObject->appendChild($dom->createElement('ChannelAssignment', $ChannelAssignment));
    $ChannelObject->appendChild($dom->createElement('AudioLanguage'));




    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnessmainaudio));

    if($request->roudnessf==0){
        $AnnotationSynopsis="";
    }else if($request->roudnessf==1){
        $AnnotationSynopsis="テープ毎";
    }else if($request->roudnessf==2){
        $AnnotationSynopsis="総尺";
    }

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeakmainaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));


    $Loudness = $AudioDescription->appendChild($dom->createElement('Loudness'));
    $Loudness->appendChild($dom->createElement('Long-termLoudness', $request->roudnesssubaudio));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'LongTermLoudness'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $AnnotationSynopsis));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

    $Annotation = $Loudness->appendChild($dom->createElement('Annotation'));
    $Annotation->appendChild($dom->createElement('AnnotationKind', 'TruePeak'));
    $Annotation->appendChild($dom->createElement('AnnotationSynopsis', $request->truepeaksubaudio));
    $Annotation->appendChild($dom->createElement('AnnotationDescription'));

}



$num03 = (int) $request->blocknum;
for ($i = 1; $i < $num03; $i++) {
    $Block = $RollFramework->appendChild($dom->createElement('Block')); 
    $BlockNumber = $dom->createAttribute('BlockNumber');
    // Value for the created attribute
    $BlockNumber->value = $i;
    // Don't forget to append it to the element
    $Block->appendChild($BlockNumber);

    $BlockTotalCount = $dom->createAttribute('BlockTotalCount');
    // Value for the created attribute
    $BlockTotalCount->value = $num03-1;
    // Don't forget to append it to the element
    $Block->appendChild($BlockTotalCount);

    $block_start="block_start".$i;
    $Block->appendChild($dom->createElement('BlockStartPosition', $request->$block_start.":00"));
    $block_end="block_end".$i;
    $Block->appendChild($dom->createElement('BlockEndPosition', $request->$block_end.":00"));
    $block_dur="block_dur".$i;
    $Block->appendChild($dom->createElement('BlockDuration', $request->$block_dur.":00"));

    $BlockDescription = $Block->appendChild($dom->createElement('BlockDescription')); 


    $block_source="block_source".$i;
    if($request->$block_source==0){
        $BlockValue="";
    }else if($request->$block_source==1){
        $BlockValue="R-1";
    }else if($request->$block_source==2){
        $BlockValue="CM1";
    }else if($request->$block_source==3){
        $BlockValue="提供1";
    }else if($request->$block_source==4){
        $BlockValue="R-2";
    }else if($request->$block_source==5){
        $BlockValue="CM2";
    }else if($request->$block_source==6){
        $BlockValue="提供2";
    }else if($request->$block_source==7){
        $BlockValue="R-3";
    }else if($request->$block_source==8){
        $BlockValue="CM3";
    }else if($request->$block_source==9){
        $BlockValue="提供3";
    }else if($request->$block_source==10){
        $BlockValue="R-4";
    }else if($request->$block_source==11){
        $BlockValue="CM4";
    }else if($request->$block_source==12){
        $BlockValue="提供4";
    }else if($request->$block_source==13){
        $BlockValue="R-5";
    }else if($request->$block_source==14){
        $BlockValue="CM5";
    }else if($request->$block_source==15){
        $BlockValue="提供5";
    }else if($request->$block_source==16){
        $BlockValue="R-6";
    }else if($request->$block_source==17){
        $BlockValue="CM6";
    }else if($request->$block_source==18){
        $BlockValue="提供6";
    }else if($request->$block_source==19){
        $BlockValue="R-7";
    }else if($request->$block_source==20){
        $BlockValue="CM7";
    }else if($request->$block_source==21){
        $BlockValue="提供7";
    }else if($request->$block_source==22){
        $BlockValue="R-8";
    }else if($request->$block_source==23){
        $BlockValue="CM8";
    }else if($request->$block_source==24){
        $BlockValue="提供8";
    }else if($request->$block_source==25){
        $BlockValue="R-9";
    }else if($request->$block_source==26){
        $BlockValue="CM9";
    }else if($request->$block_source==27){
        $BlockValue="提供9";
    }else if($request->$block_source==28){
        $BlockValue="R-10";
    }else if($request->$block_source==29){
        $BlockValue="CM10";
    }else if($request->$block_source==30){
        $BlockValue="提供10";
    }else if($request->$block_source==31){
        $BlockValue="R-11";
    }else if($request->$block_source==30){
        $BlockValue="CM11";
    }else if($request->$block_source==33){
        $BlockValue="R-12";
    }else if($request->$block_source==34){
        $BlockValue="CM12";
    }else if($request->$block_source==35){
        $BlockValue="R-13";
    }else if($request->$block_source==36){
        $BlockValue="CM13";
    }else if($request->$block_source==37){
        $BlockValue="R-14";
    }else if($request->$block_source==38){
        $BlockValue="CM14";
    }else if($request->$block_source==39){
        $BlockValue="R-15";
    }else if($request->$block_source==40){
        $BlockValue="CM15";
    }else if($request->$block_source==41){
        $BlockValue="R-16";
    }else if($request->$block_source==42){
        $BlockValue="R-17";
    }else if($request->$block_source==43){
        $BlockValue="R-18";
    }else if($request->$block_source==44){
        $BlockValue="R-19";
    }else if($request->$block_source==45){
        $BlockValue="R-20";
    }



    $block_obj="block_obj".$i;
    if($request->$block_obj==0){
        $BlockKind="PG";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==1){
        $BlockKind="CM";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==2){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==3){
        $BlockKind="BB";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==4){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==5){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="2";
    }else if($request->$block_obj==6){
        $BlockKind="SC";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="3";
    }else if($request->$block_obj==7){
        $BlockKind="CM";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="1";
    }else if($request->$block_obj==8){
        $BlockKind="NS";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==9){
        $BlockKind="PG";
        $BlockSubNumber=substr($BlockValue, 2);
        $BlockValue1="0";
    }else if($request->$block_obj==10){
        $BlockKind="CB";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==11){
        $BlockKind="CR";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==12){
        $BlockKind="LC";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==13){
        $BlockKind="FC";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==14){
        $BlockKind="END";
        $BlockSubNumber="";
        $BlockValue1="";
    }else if($request->$block_obj==15){
        $BlockKind="";
        $BlockSubNumber="";
        $BlockValue1="";
    }
    $BlockDescription->appendChild($dom->createElement('BlockKind', $BlockKind));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubNumber',$BlockSubNumber));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubKind','BlockName'));
    $BlockSubInfo->appendChild($dom->createElement('BlockValue',$BlockValue));

    $BlockSubInfo = $BlockDescription->appendChild($dom->createElement('BlockSubInfo')); 
    $BlockSubInfo->appendChild($dom->createElement('BlockSubKind','BlockSignal'));
    $BlockSubInfo->appendChild($dom->createElement('BlockValue',$BlockValue1));

    $block_bik="block_bik".$i;

    $Annotation = $BlockDescription->appendChild($dom->createElement('Annotation')); 
    $Annotation->appendChild($dom->createElement('AnnotationKind','BlockMemo'));
    $Annotation->appendChild($dom->createElement('AnnotationDescription',$request->$block_bik));
}

$num04 = (int) $request->keynum;
for ($i = 1; $i <= $num04; $i++) {
    $Keypoint = $RollFramework->appendChild($dom->createElement('Keypoint')); 
    $key_shu="key_shu".$i;
    $Keypoint->appendChild($dom->createElement('KeypointKind', $request->$key_shu));
    $key_start="key_start".$i;
    $Keypoint->appendChild($dom->createElement('KeypointPosition', $request->$key_start.":00"));
    $key_dur="key_dur".$i;
    $Keypoint->appendChild($dom->createElement('KeypointDuration', $request->$key_dur.":00"));
    $key_nai="key_nai".$i;
    $Keypoint->appendChild($dom->createElement('KeypointValue', $request->$key_nai));

}


//XML出力
$fileName = 'PEM_'.$request->fileid.'.xml';
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename='.$fileName);
echo $dom->saveXML();


    
    





    }

    public function show(Request $request){
        $housoubi=substr($request->housoubi, 0, 4).'年'.substr($request->housoubi, 5, 2).'月'.substr($request->housoubi, 8, 2).'日';

        if($request->youtof=="0"){
            $youto="";
        }elseif($request->youtof=="1"){
            $youto="放送";
        }elseif($request->youtof=="2"){
            $youto="放送予備";
        }elseif($request->youtof=="3"){
            $youto="ネット";
        }elseif($request->youtof=="4"){
            $youto="保存";
        }elseif($request->youtof=="5"){
            $youto="裏送り";
        }elseif($request->youtof=="6"){
            $youto="番組管理";
        }elseif($request->youtof=="7"){
            $youto="素材";
        }elseif($request->youtof=="8"){
            $youto="素材予備";
        }elseif($request->youtof=="9"){
            $youto="その他";
        }
    
        if($request->mediashubetuf=="0"){
            $mediashubetu="";
        }elseif($request->mediashubetuf=="1"){
            $mediashubetu="XDCAM";
        }elseif($request->mediashubetuf=="2"){
            $mediashubetu="HDCAM";
        }elseif($request->mediashubetuf=="3"){
            $mediashubetu="HDCAM-SR";
        }
    
    
        if($request->oaf=="0"){
            $oa="";
        }elseif($request->oaf=="1"){
            $oa="地上波";
        }elseif($request->oaf=="2"){
            $oa="BS";
        }elseif($request->oaf=="3"){
            $oa="CS";
        }elseif($request->oaf=="4"){
            $oa="裏送り";
        }elseif($request->oaf=="5"){
            $oa="その他";
        }
    
    
    
    
        //$blocknum=0;
        $block_starth=[];
        $block_endh=[];
        $block_durh=[];
        $block_objh=[];
        $block_sourceh=[];
        $block_bikh=[];
        $blocknumh=[];
    
        $blocknum=(int)$request->blocknum;
    
        array_push($blocknumh, floor($blocknum / 10));
        array_push($blocknumh, $blocknum % 10);
    
        
    
        for ($i = 1; $i <= $blocknum; $i++) {
            $block_start="block_start".$i;
            array_push($block_starth, $request->$block_start);
            $block_end="block_end".$i;
            array_push($block_endh, $request->$block_end);
            $block_dur="block_dur".$i;
            array_push($block_durh, $request->$block_dur);
            $block_obj="block_obj".$i;
            

            if($request->$block_obj==0){
                $BlockKind="PG";
            }else if($request->$block_obj==1){
                $BlockKind="CM";
            }else if($request->$block_obj==2){
                $BlockKind="SC";
            }else if($request->$block_obj==3){
                $BlockKind="BB";
            }else if($request->$block_obj==4){
                $BlockKind="SC";
            }else if($request->$block_obj==5){
                $BlockKind="SC";
            }else if($request->$block_obj==6){
                $BlockKind="SC";
            }else if($request->$block_obj==7){
                $BlockKind="CM";
            }else if($request->$block_obj==8){
                $BlockKind="NS";
            }else if($request->$block_obj==9){
                $BlockKind="PG";
            }else if($request->$block_obj==10){
                $BlockKind="CB";
            }else if($request->$block_obj==11){
                $BlockKind="CR";
            }else if($request->$block_obj==12){
                $BlockKind="LC";
            }else if($request->$block_obj==13){
                $BlockKind="FC";
            }else if($request->$block_obj==14){
                $BlockKind="END";
            }else if($request->$block_obj==15){
                $BlockKind="";
            }
            array_push($block_objh, $BlockKind);
            $block_source="block_source".$i;
            
            if($request->$block_source==0){
                $BlockValue="";
            }else if($request->$block_source==1){
                $BlockValue="R-1";
            }else if($request->$block_source==2){
                $BlockValue="CM1";
            }else if($request->$block_source==3){
                $BlockValue="提供1";
            }else if($request->$block_source==4){
                $BlockValue="R-2";
            }else if($request->$block_source==5){
                $BlockValue="CM2";
            }else if($request->$block_source==6){
                $BlockValue="提供2";
            }else if($request->$block_source==7){
                $BlockValue="R-3";
            }else if($request->$block_source==8){
                $BlockValue="CM3";
            }else if($request->$block_source==9){
                $BlockValue="提供3";
            }else if($request->$block_source==10){
                $BlockValue="R-4";
            }else if($request->$block_source==11){
                $BlockValue="CM4";
            }else if($request->$block_source==12){
                $BlockValue="提供4";
            }else if($request->$block_source==13){
                $BlockValue="R-5";
            }else if($request->$block_source==14){
                $BlockValue="CM5";
            }else if($request->$block_source==15){
                $BlockValue="提供5";
            }else if($request->$block_source==16){
                $BlockValue="R-6";
            }else if($request->$block_source==17){
                $BlockValue="CM6";
            }else if($request->$block_source==18){
                $BlockValue="提供6";
            }else if($request->$block_source==19){
                $BlockValue="R-7";
            }else if($request->$block_source==20){
                $BlockValue="CM7";
            }else if($request->$block_source==21){
                $BlockValue="提供7";
            }else if($request->$block_source==22){
                $BlockValue="R-8";
            }else if($request->$block_source==23){
                $BlockValue="CM8";
            }else if($request->$block_source==24){
                $BlockValue="提供8";
            }else if($request->$block_source==25){
                $BlockValue="R-9";
            }else if($request->$block_source==26){
                $BlockValue="CM9";
            }else if($request->$block_source==27){
                $BlockValue="提供9";
            }else if($request->$block_source==28){
                $BlockValue="R-10";
            }else if($request->$block_source==29){
                $BlockValue="CM10";
            }else if($request->$block_source==30){
                $BlockValue="提供10";
            }else if($request->$block_source==31){
                $BlockValue="R-11";
            }else if($request->$block_source==30){
                $BlockValue="CM11";
            }else if($request->$block_source==33){
                $BlockValue="R-12";
            }else if($request->$block_source==34){
                $BlockValue="CM12";
            }else if($request->$block_source==35){
                $BlockValue="R-13";
            }else if($request->$block_source==36){
                $BlockValue="CM13";
            }else if($request->$block_source==37){
                $BlockValue="R-14";
            }else if($request->$block_source==38){
                $BlockValue="CM14";
            }else if($request->$block_source==39){
                $BlockValue="R-15";
            }else if($request->$block_source==40){
                $BlockValue="CM15";
            }else if($request->$block_source==41){
                $BlockValue="R-16";
            }else if($request->$block_source==42){
                $BlockValue="R-17";
            }else if($request->$block_source==43){
                $BlockValue="R-18";
            }else if($request->$block_source==44){
                $BlockValue="R-19";
            }else if($request->$block_source==45){
                $BlockValue="R-20";
            }
            array_push($block_sourceh, $BlockValue);
            $block_bik="block_bik".$i;
            array_push($block_bikh, $request->$block_bik);
        }
    
    
        if($request->roudnessf=="0"){
            $roudness="";
        }elseif($request->roudnessf=="1"){
            $roudness="テープ毎";
        }elseif($request->roudnessf=="2"){
            $roudness="総尺";
        }
    
    
    
        if($request->onseimodef=="0"){
            $onseimode="";
        }elseif($request->onseimodef=="1"){
            $onseimode="ステレオ";
        }elseif($request->onseimodef=="2"){
            $onseimode="モノラル";
        }elseif($request->onseimodef=="3"){
            $onseimode="デュアルモノラル";
        }elseif($request->onseimodef=="4"){
            $onseimode="3モノラル";
        }elseif($request->onseimodef=="5"){
            $onseimode="デュアルステレオ";
        }elseif($request->onseimodef=="6"){
            $onseimode="5.1チャンネル";
        }elseif($request->onseimodef=="7"){
            $onseimode="5.1チャンネルステレオ+ステレオ";
        }
    
    
        if($request->ch01f=="0"){
            $ch01="";
        }elseif($request->ch01f=="1"){
            $ch01="L";
        }elseif($request->ch01f=="2"){
            $ch01="R";
        }elseif($request->ch01f=="3"){
            $ch01="MIX L";
        }elseif($request->ch01f=="4"){
            $ch01="MIX R";
        }elseif($request->ch01f=="5"){
            $ch01="MONO";
        }elseif($request->ch01f=="6"){
            $ch01="主音声";
        }elseif($request->ch01f=="7"){
            $ch01="副音声";
        }elseif($request->ch01f=="8"){
            $ch01="副音声1";
        }elseif($request->ch01f=="9"){
            $ch01="副音声2";
        }elseif($request->ch01f=="10"){
            $ch01="主音声L";
        }elseif($request->ch01f=="11"){
            $ch01="主音声R";
        }elseif($request->ch01f=="12"){
            $ch01="副音声L";
        }elseif($request->ch01f=="13"){
            $ch01="副音声R";
        }elseif($request->ch01f=="14"){
            $ch01="C";
        }elseif($request->ch01f=="15"){
            $ch01="LFE";
        }elseif($request->ch01f=="16"){
            $ch01="SL";
        }elseif($request->ch01f=="17"){
            $ch01="SR";
        }elseif($request->ch01f=="18"){
            $ch01="その他";
        }
    
    
    
        if($request->ch02f=="0"){
            $ch02="";
        }elseif($request->ch02f=="1"){
            $ch02="L";
        }elseif($request->ch02f=="2"){
            $ch02="R";
        }elseif($request->ch02f=="3"){
            $ch02="MIX L";
        }elseif($request->ch02f=="4"){
            $ch02="MIX R";
        }elseif($request->ch02f=="5"){
            $ch02="MONO";
        }elseif($request->ch02f=="6"){
            $ch02="主音声";
        }elseif($request->ch02f=="7"){
            $ch02="副音声";
        }elseif($request->ch02f=="8"){
            $ch02="副音声1";
        }elseif($request->ch02f=="9"){
            $ch02="副音声2";
        }elseif($request->ch02f=="10"){
            $ch02="主音声L";
        }elseif($request->ch02f=="11"){
            $ch02="主音声R";
        }elseif($request->ch02f=="12"){
            $ch02="副音声L";
        }elseif($request->ch02f=="13"){
            $ch02="副音声R";
        }elseif($request->ch02f=="14"){
            $ch02="C";
        }elseif($request->ch02f=="15"){
            $ch02="LFE";
        }elseif($request->ch02f=="16"){
            $ch02="SL";
        }elseif($request->ch02f=="17"){
            $ch02="SR";
        }elseif($request->ch02f=="18"){
            $ch02="その他";
        }
    
    
        if($request->ch03f=="0"){
            $ch03="";
        }elseif($request->ch03f=="1"){
            $ch03="L";
        }elseif($request->ch03f=="2"){
            $ch03="R";
        }elseif($request->ch03f=="3"){
            $ch03="MIX L";
        }elseif($request->ch03f=="4"){
            $ch03="MIX R";
        }elseif($request->ch03f=="5"){
            $ch03="MONO";
        }elseif($request->ch03f=="6"){
            $ch03="主音声";
        }elseif($request->ch03f=="7"){
            $ch03="副音声";
        }elseif($request->ch03f=="8"){
            $ch03="副音声1";
        }elseif($request->ch03f=="9"){
            $ch03="副音声2";
        }elseif($request->ch03f=="10"){
            $ch03="主音声L";
        }elseif($request->ch03f=="11"){
            $ch03="主音声R";
        }elseif($request->ch03f=="12"){
            $ch03="副音声L";
        }elseif($request->ch03f=="13"){
            $ch03="副音声R";
        }elseif($request->ch03f=="14"){
            $ch03="C";
        }elseif($request->ch03f=="15"){
            $ch03="LFE";
        }elseif($request->ch03f=="16"){
            $ch03="SL";
        }elseif($request->ch03f=="17"){
            $ch03="SR";
        }elseif($request->ch03f=="18"){
            $ch03="その他";
        }
    
    
        if($request->ch04f=="0"){
            $ch04="";
        }elseif($request->ch04f=="1"){
            $ch04="L";
        }elseif($request->ch04f=="2"){
            $ch04="R";
        }elseif($request->ch04f=="3"){
            $ch04="MIX L";
        }elseif($request->ch04f=="4"){
            $ch04="MIX R";
        }elseif($request->ch04f=="5"){
            $ch04="MONO";
        }elseif($request->ch04f=="6"){
            $ch04="主音声";
        }elseif($request->ch04f=="7"){
            $ch04="副音声";
        }elseif($request->ch04f=="8"){
            $ch04="副音声1";
        }elseif($request->ch04f=="9"){
            $ch04="副音声2";
        }elseif($request->ch04f=="10"){
            $ch04="主音声L";
        }elseif($request->ch04f=="11"){
            $ch04="主音声R";
        }elseif($request->ch04f=="12"){
            $ch04="副音声L";
        }elseif($request->ch04f=="13"){
            $ch04="副音声R";
        }elseif($request->ch04f=="14"){
            $ch04="C";
        }elseif($request->ch04f=="15"){
            $ch04="LFE";
        }elseif($request->ch04f=="16"){
            $ch04="SL";
        }elseif($request->ch04f=="17"){
            $ch04="SR";
        }elseif($request->ch04f=="18"){
            $ch04="その他";
        }
    
    
    
        if($request->ch05f=="0"){
            $ch05="";
        }elseif($request->ch05f=="1"){
            $ch05="L";
        }elseif($request->ch05f=="2"){
            $ch05="R";
        }elseif($request->ch05f=="3"){
            $ch05="MIX L";
        }elseif($request->ch05f=="4"){
            $ch05="MIX R";
        }elseif($request->ch05f=="5"){
            $ch05="MONO";
        }elseif($request->ch05f=="6"){
            $ch05="主音声";
        }elseif($request->ch05f=="7"){
            $ch05="副音声";
        }elseif($request->ch05f=="8"){
            $ch05="副音声1";
        }elseif($request->ch05f=="9"){
            $ch05="副音声2";
        }elseif($request->ch05f=="10"){
            $ch05="主音声L";
        }elseif($request->ch05f=="11"){
            $ch05="主音声R";
        }elseif($request->ch05f=="12"){
            $ch05="副音声L";
        }elseif($request->ch05f=="13"){
            $ch05="副音声R";
        }elseif($request->ch05f=="14"){
            $ch05="C";
        }elseif($request->ch05f=="15"){
            $ch05="LFE";
        }elseif($request->ch05f=="16"){
            $ch05="SL";
        }elseif($request->ch05f=="17"){
            $ch05="SR";
        }elseif($request->ch05f=="18"){
            $ch05="その他";
        }
    
    
    
        if($request->ch06f=="0"){
            $ch06="";
        }elseif($request->ch06f=="1"){
            $ch06="L";
        }elseif($request->ch06f=="2"){
            $ch06="R";
        }elseif($request->ch06f=="3"){
            $ch06="MIX L";
        }elseif($request->ch06f=="4"){
            $ch06="MIX R";
        }elseif($request->ch06f=="5"){
            $ch06="MONO";
        }elseif($request->ch06f=="6"){
            $ch06="主音声";
        }elseif($request->ch06f=="7"){
            $ch06="副音声";
        }elseif($request->ch06f=="8"){
            $ch06="副音声1";
        }elseif($request->ch06f=="9"){
            $ch06="副音声2";
        }elseif($request->ch06f=="10"){
            $ch06="主音声L";
        }elseif($request->ch06f=="11"){
            $ch06="主音声R";
        }elseif($request->ch06f=="12"){
            $ch06="副音声L";
        }elseif($request->ch06f=="13"){
            $ch06="副音声R";
        }elseif($request->ch06f=="14"){
            $ch06="C";
        }elseif($request->ch06f=="15"){
            $ch06="LFE";
        }elseif($request->ch06f=="16"){
            $ch06="SL";
        }elseif($request->ch06f=="17"){
            $ch06="SR";
        }elseif($request->ch06f=="18"){
            $ch06="その他";
        }
    
    
    
    
        if($request->ch07f=="0"){
            $ch07="";
        }elseif($request->ch07f=="1"){
            $ch07="L";
        }elseif($request->ch07f=="2"){
            $ch07="R";
        }elseif($request->ch07f=="3"){
            $ch07="MIX L";
        }elseif($request->ch07f=="4"){
            $ch07="MIX R";
        }elseif($request->ch07f=="5"){
            $ch07="MONO";
        }elseif($request->ch07f=="6"){
            $ch07="主音声";
        }elseif($request->ch07f=="7"){
            $ch07="副音声";
        }elseif($request->ch07f=="8"){
            $ch07="副音声1";
        }elseif($request->ch07f=="9"){
            $ch07="副音声2";
        }elseif($request->ch07f=="10"){
            $ch07="主音声L";
        }elseif($request->ch07f=="11"){
            $ch07="主音声R";
        }elseif($request->ch07f=="12"){
            $ch07="副音声L";
        }elseif($request->ch07f=="13"){
            $ch07="副音声R";
        }elseif($request->ch07f=="14"){
            $ch07="C";
        }elseif($request->ch07f=="15"){
            $ch07="LFE";
        }elseif($request->ch07f=="16"){
            $ch07="SL";
        }elseif($request->ch07f=="17"){
            $ch07="SR";
        }elseif($request->ch07f=="18"){
            $ch07="その他";
        }
    
    
    
    
        if($request->ch08f=="0"){
            $ch08="";
        }elseif($request->ch08f=="1"){
            $ch08="L";
        }elseif($request->ch08f=="2"){
            $ch08="R";
        }elseif($request->ch08f=="3"){
            $ch08="MIX L";
        }elseif($request->ch08f=="4"){
            $ch08="MIX R";
        }elseif($request->ch08f=="5"){
            $ch08="MONO";
        }elseif($request->ch08f=="6"){
            $ch08="主音声";
        }elseif($request->ch08f=="7"){
            $ch08="副音声";
        }elseif($request->ch08f=="8"){
            $ch08="副音声1";
        }elseif($request->ch08f=="9"){
            $ch08="副音声2";
        }elseif($request->ch08f=="10"){
            $ch08="主音声L";
        }elseif($request->ch08f=="11"){
            $ch08="主音声R";
        }elseif($request->ch08f=="12"){
            $ch08="副音声L";
        }elseif($request->ch08f=="13"){
            $ch08="副音声R";
        }elseif($request->ch08f=="14"){
            $ch08="C";
        }elseif($request->ch08f=="15"){
            $ch08="LFE";
        }elseif($request->ch08f=="16"){
            $ch08="SL";
        }elseif($request->ch08f=="17"){
            $ch08="SR";
        }elseif($request->ch08f=="18"){
            $ch08="その他";
        }
    
    
    
    
        $sagyounum=(int)$request->sagyounum;
        $sagyou_sagyoubih=[];
        $sagyou_naiyouh=[];
        $sagyou_seih=[];
        $sagyou_meih=[];
        $sagyou_nameh=[];
        $sagyou_kaishah=[];
        $sagyou_renrakuh=[];
        $sagyou_shurokuh=[];
    
        for ($i = 1; $i <= $sagyounum; $i++) {
            $sagyou_sagyoubi="sagyou_sagyoubi".$i;
            array_push($sagyou_sagyoubih, $request->$sagyou_sagyoubi);
            $sagyou_naiyou="sagyou_naiyou".$i;
            $sagyou_naiyou="sagyou_naiyou".$i;
            if($request->$sagyou_naiyou==0){
                $ContributionStatus="REC";
            }else if($request->$sagyou_naiyou==1){
                $ContributionStatus="PB";
            }else if($request->$sagyou_naiyou==2){
                $ContributionStatus="DUB";
            }else if($request->$sagyou_naiyou==3){
                $ContributionStatus="ED";
            }else if($request->$sagyou_naiyou==4){
                $ContributionStatus="ING";
            }else if($request->$sagyou_naiyou==5){
                $ContributionStatus="MA";
            }else if($request->$sagyou_naiyou==6){
                $ContributionStatus="PV";
            }else if($request->$sagyou_naiyou==7){
                $ContributionStatus="OA";
            }else if($request->$sagyou_naiyou==8){
                $ContributionStatus="(OA)";
            }else if($request->$sagyou_naiyou==9){
                $ContributionStatus="ERA";
            }else if($request->$sagyou_naiyou==10){
                $ContributionStatus="Meta";
            }else if($request->$sagyou_naiyou==11){
                $ContributionStatus="その他";
            }
            array_push($sagyou_naiyouh, $ContributionStatus);
            $sagyou_sei="sagyou_sei".$i;
            $sagyou_mei="sagyou_mei".$i;
            array_push($sagyou_nameh, $request->$sagyou_sei.$request->$sagyou_mei);
            $sagyou_kaisha="sagyou_kaisha".$i;
            array_push($sagyou_kaishah, $request->$sagyou_kaisha);
            $sagyou_renraku="sagyou_renraku".$i;
            array_push($sagyou_renrakuh, $request->$sagyou_renraku);
        }
    
    
    
    
    
    
    
    
    
        $seisakunum=(int)$request->seisakunum;
        $seisaku_shokushuh=[];
        $seisaku_seih=[];
        $seisaku_meih=[];
        $seisaku_nameh=[];
        $seisaku_kaishah=[];
        $seisaku_renrakuh=[];
    
    
        for ($i = 1; $i <= $seisakunum; $i++) {
            $seisaku_shokushu="seisaku_shokushu".$i;
            array_push($seisaku_shokushuh, $request->$seisaku_shokushu);
            $seisaku_sei="seisaku_sei".$i;
            $seisaku_mei="seisaku_mei".$i;
            array_push($seisaku_nameh, $request->$seisaku_sei.$request->$seisaku_mei);
            $seisaku_kaisha="seisaku_kaisha".$i;
            array_push($seisaku_kaishah, $request->$seisaku_kaisha);
            $seisaku_renraku="seisaku_renraku".$i;
            array_push($seisaku_renrakuh, $request->$seisaku_renraku);
        }
            
        
    
    
    
    
    
    
    
    
    
    
        $params=[
            'today'=>date("Y/m/d"),
            'title'=>$request->title,
            'mediano'=>$request->mediano,
            'housoubi'=>$housoubi,
            'subtitle'=>$request->subtitle,
            'wasuu'=>$request->wasuu,
            'roll'=>$request->roll1.'/'.$request->roll2,
            'youto'=>$youto,
            'honkai'=>$request->honkai,
            'honzen'=>$request->honzen,
            'eizou'=>$request->eizou,
            'mediashubetu'=>$mediashubetu,
            'mediaformat'=>$request->mediaformat,
            'oa'=>$oa,
    
            'blocknum'=>$blocknum,
            'block_start'=>$block_starth,
            'block_end'=>$block_endh,
            'block_dur'=>$block_durh,
            'block_obj'=>$block_objh,
            'block_source'=>$block_sourceh,
            'block_bik'=>$block_bikh,
            'blocknumh'=>$blocknumh,
    
            'housoukyoku'=>$request->housoukyoku,
            'roudness'=>$roudness,
            'onseimode'=>$onseimode,
            'ch01'=>$ch01,
            'ch02'=>$ch02,
            'ch03'=>$ch03,
            'ch04'=>$ch04,
            'ch05'=>$ch05,
            'ch06'=>$ch06,
            'ch07'=>$ch07,
            'ch08'=>$ch08,
    
            'roudnessmainaudio'=>$request->roudnessmainaudio,
            'truepeakmainaudio'=>$request->truepeakmainaudio,
            'roudnesssubaudio'=>$request->roudnesssubaudio,
            'truepeaksubaudio'=>$request->truepeaksubaudio,
            'roudnesssanaudio'=>$request->roudnesssanaudio,
            'truepeaksanaudio'=>$request->truepeaksanaudio,
    
            'fileid'=>$request->fileid,
            'memo'=>$request->memo,
            
    
            'sagyounum'=>$sagyounum,
            'sagyou_sagyoubi'=>$sagyou_sagyoubih,
            'sagyou_naiyou'=>$sagyou_naiyouh,
            'sagyou_name'=>$sagyou_nameh,
            'sagyou_kaisha'=>$sagyou_kaishah,
            'sagyou_renraku'=>$sagyou_renrakuh,
    
            'seisakunum'=>$seisakunum,
            'seisaku_shokushu'=>$seisaku_shokushuh,
            'seisaku_name'=>$seisaku_nameh,
            'seisaku_kaisha'=>$seisaku_kaishah,
            'seisaku_renraku'=>$seisaku_renrakuh,
            
        ];
    
            $pdf = \PDF::loadView('hello.show',['items'=>$params]);
    
            $filename=$request->fileid;
    
            return $pdf->download('JOB_'.$filename.'.pdf');
            
    
    
    
    
    
    
    }

    public function store(Request $request){
        $file = $request->file('file');

        if (!is_null($file)) {

            date_default_timezone_set('Asia/Tokyo');

            $originalName = $file->getClientOriginalName();
            $micro = explode(" ", microtime());
            $fileTail = date("Ymd_His", $micro[1]) . '_' . (explode('.', $micro[0])[1]);

            $dir = '';
            $fileName = $originalName ;
            $file->storeAs($dir, $fileName, ['disk' => 'local']);

        }

        $xml = "../storage/app/".$fileName ;//ファイルを指定
        $xmlData = simplexml_load_file($xml);//xmlを読み込む

        $params=[
            'name'=>$xmlData->MetadataId,
            'mail'=>"asai",
            'age'=>"asai",
        ];
        return view('hello.index',['items'=>$params]);



    }

    public function exa(Request $request){
        // ログインしていたら、test/menuを表示
        if (Auth::check()) {
            return view('hello.exa');
        } else {
            // ログインしていなかったら、Login画面を表示
            return view('auth/login');
        }
       // return view('hello.exa');
    }
}
