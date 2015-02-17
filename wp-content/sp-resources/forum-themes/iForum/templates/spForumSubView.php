<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	iForum
#	Template	:	forum
#	Author		:	Simple:Press
#
#	The 'forum' template is used to display the Forum/Topic Index Listing
#
# --------------------------------------------------------------------------------------

	# == ADD TOPIC FORM - OBJECT DEFINITION ========================
	$addTopicForm = array(
		'tagClass'				=> 'spForm',
		'controlFieldset'		=> '',
		'controlInput'			=> 'spControl',
		'controlSubmit'			=> 'spSubmit',
		'labelHeading'			=> __sp('Add new topic'),
		'labelGuestName'		=> __sp('Guest name (required)'),
		'labelGuestEmail'		=> __sp('Guest email (required)'),
		'labelModerateAll'		=> __sp('NOTE: new posts are subject to administrator approval before being displayed'),
		'labelModerateOnce'		=> __sp('NOTE: first posts are subject to administrator approval before being displayed'),
		'labelTopicName'		=> __sp('Topic name'),
		'labelSmileys'			=> __sp('Smileys'),
		'labelOptions'			=> __sp('Options'),
		'labelOptionLock'		=> __sp('Lock this topic'),
		'labelOptionPin'		=> __sp('Pin this topic'),
		'labelOptionTime'		=> __sp('Edit topic timestamp'),
		'labelMath'				=> __sp('Math required'),
		'labelMathSum'			=> __sp('What is the sum of'),
		'labelPostButtonReady'	=> __sp('Post New Topic'),
		'labelPostButtonMath'	=> __sp('Do Math To Save'),
		'labelPostCancel'		=> __sp('Cancel'),
		'tipSmileysButton'		=> __sp('Open/Close to Add a Smiley'),
		'tipOptionsButton'		=> __sp('Open/Close to select Posting Options'),
		'tipSubmitButton'		=> __sp('Save the New Topic'),
		'tipCancelButton'		=> __sp('Cancel the New Topic')
	);
	# ==============================================================


	# Start the 'forumView' column
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spListSection', 'forumView');

		# Set the Forum
		# ----------------------------------------------------------------------
		if (sp_this_forum()):

			# Start the 'forumHeader' section
			# ----------------------------------------------------------------------
			sp_SectionStart('tagClass=spForumViewSection', 'forum');
				sp_TopicNewButton('tagClass=spButton spRight', __sp('New Topic'), __sp('Start a new topic'), __sp('This forum is locked'));
				sp_ForumHeaderName('tagClass=spHeaderName');
				sp_ForumHeaderDescription('tagClass=spHeaderDescription');
				sp_ForumHeaderSubForums('unreadIcon=sp_SubForumUnreadIcon.png', __sp('Sub-Forums'), __sp('Browse topics in %NAME%'));

				sp_SectionStart('tagClass=spForumTopicContainer', 'topiclist');

					# Start the Topic Loop
					# ----------------------------------------------------------------------
					if (sp_has_topics()) : while (sp_loop_topics()) : sp_the_topic();

						# Start the 'topic' section
						# ----------------------------------------------------------------------
						sp_SectionStart('tagClass=spForumTopicSection', 'topic');

							# Column 1 of the topic row
							# ----------------------------------------------------------------------
							sp_ColumnStart('tagClass=spColumnSection spLeft&width=86%&height=50px');
								sp_TopicIndexName('tagClass=spRowName', __sp('Browse the thread %NAME%'));
                                if (function_exists('sp_TopicDescription')) sp_TopicDescription();
								sp_TopicIndexLastPost('labelClass=spInRowLabel spLeft&iconClass=spIcon spLeft&stack=0', __sp('Last Post'));
							sp_ColumnEnd();

							# Column 2 of the forum row
							# ----------------------------------------------------------------------
							sp_ColumnStart('tagClass=spColumnSection spRight&width=14%&height=50px');
								sp_TopicIndexPostCount('tagClass=spInRowCount', __sp('Posts'), __sp('Post'));
								sp_TopicIndexStatusIcons('tagClass=spStatusIcon spCenter', __sp('This topic is locked'), __sp('This topic is pinned'), __sp('This topic has unread posts'));
								if (function_exists('sp_TopicIndexRating')) sp_TopicIndexRating('tagClass=spTopicRating spCenter');
							sp_ColumnEnd();

							sp_InsertBreak();

						sp_SectionEnd('', 'topic');

					endwhile; else:
						sp_NoTopicsInForumMessage('tagClass=spMessage', __sp('There are no topics in this forum'));
					endif;

				sp_SectionEnd('', 'topiclist');

			sp_SectionEnd('', 'forum');

			# Start the 'pagelinks' section
			# ----------------------------------------------------------------------
			sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
				sp_TopicNewButton('tagClass=spButton spRight', __sp('New Topic'), __sp('Start a new topic'), __sp('This forum is locked'));
				sp_TopicIndexPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of topics'), __sp('Jump to page'));
				sp_InsertBreak();
			sp_SectionEnd('', 'pageLinks');

			# Start the 'editor' section
			# ----------------------------------------------------------------------
			sp_SectionStart('tagClass=spHiddenSection', 'editor');
				sp_TopicEditorWindow($addTopicForm);
			sp_SectionEnd('', 'editor');
		else:
			sp_NoForumMessage('tagClass=spMessage', __sp('Access denied - you do not have permission to view this page'), __sp('The requested forum does not exist'));
		endif;

	sp_SectionEnd('', 'forumView');

?>