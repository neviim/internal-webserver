<?php

/*
 * Copyright 2012 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

final class DifferentialInlineCommentPreviewController
extends PhabricatorInlineCommentPreviewController {

  private $revisionID;

  public function willProcessRequest(array $data) {
    $this->revisionID = $data['id'];
  }

  protected function loadInlineComments() {
    $user = $this->getRequest()->getUser();

    $inlines = id(new DifferentialInlineComment())->loadAllWhere(
      'authorPHID = %s AND revisionID = %d AND commentID IS NULL',
      $user->getPHID(),
      $this->revisionID);

    return $inlines;
  }

}
