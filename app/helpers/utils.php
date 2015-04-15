<?php namespace helpers;

/*
 * Session Class - prefix sessions with useful methods
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.0
 * @date June 27, 2014
 */
class Utils {

  public static function getMapperType($changesets) {
    $mapper_type='';
    if ($changesets>=2000){
      $mapper_type='Gold';
    } elseif ($changesets>=500) {
      $mapper_type='Senior+';
    } elseif ($changesets>=100) {
      $mapper_type='Senior';
    } elseif ($changesets>=10) {
      $mapper_type='Junior';
    } else{
      $mapper_type='Nonrecurring';
    }
    return $mapper_type;
  }

}
