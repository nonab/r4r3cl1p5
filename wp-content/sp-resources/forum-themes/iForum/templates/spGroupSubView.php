<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	iForum
#	Template	:	group
#	Author		:	Simple:Press
#
#	The 'group' template is used to display the Group/Forum Index Listing
#
# --------------------------------------------------------------------------------------

	# Start the 'groupView' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spListSection', 'groupView');

		# Start the Group Loop
		# ----------------------------------------------------------------------
		if (sp_has_groups()) : while (sp_loop_groups()) : sp_the_group();

			# Start the 'groupHeader' section
			# ----------------------------------------------------------------------
			sp_SectionStart('tagClass=spGroupViewSection', 'group');
				sp_GroupHeaderName('tagClass=spHeaderName');
				sp_GroupHeaderDescription('tagClass=spHeaderDescription');

				sp_SectionStart('tagClass=spGroupForumContainer', 'forumlist');

					# Start the Forum Loop
					# ----------------------------------------------------------------------
					if (sp_has_forums()) : while (sp_loop_forums()) : sp_the_forum();

						# Start the 'forum' section
						# ----------------------------------------------------------------------
						sp_SectionStart('tagClass=spGroupForumSection', 'forum');

							# Column 1 of the forum row
							# ----------------------------------------------------------------------
							sp_ColumnStart('tagClass=spColumnSection spLeft&width=100%&height=55px');
								sp_ForumIndexName('tagClass=spRowName', __sp('Browse topics in %NAME%'));
								sp_ForumIndexDescription('tagClass=spRowDescription');
								sp_ForumIndexPageLinks('tagClass=spInRowPageLinks spLeft', __sp('Jump to page %PAGE% of topics'));
								sp_ForumIndexStatusIcons('tagClass=spStatusIcon spRight', __sp('This forum is locked'), __sp('This forum has unread posts in %COUNT% topic(s)'));
							sp_ColumnEnd();

							sp_InsertBreak();

							sp_ForumIndexSubForums('unreadIcon=sp_SubForumUnreadIcon.png', __sp('Sub-Forums'), __sp('Browse topics in %NAME%'));
						sp_SectionEnd('', 'forum');
					endwhile; else:
						sp_NoForumsInGroupMessage('tagClass=spMessage', __sp('There are no forums in this group'));
					endif;

				sp_SectionEnd('', 'forumlist');

			sp_SectionEnd('', 'group');
		endwhile; else:
			sp_NoGroupMessage('tagClass=spMessage', __sp('The requested group does not exist or you do not have permission to view it'), __sp('No groups have been created yet'));
		endif;

	sp_SectionEnd('', 'groupView');

?>