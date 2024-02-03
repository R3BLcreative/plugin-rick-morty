<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://r3blcreative.com
 * @since      1.0.0
 *
 * @package    Plugin_Rick_Morty
 * @subpackage Plugin_Rick_Morty/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="!tw-w-full !tw-max-w-full mobile:tw-p-10 laptop:tw-p-24 tw-bg-gray-800 tw-text-slate-900 tw-rounded-lg tw-grid mobile:tw-grid-cols-2 laptop:tw-grid-cols-3 desktop:tw-grid-cols-4 tw-gap-6">
	<?php
	if (isset($error)) {
		echo $error;
	} else {
		foreach ($characters as $character) :
	?>
			<div class="tw-bg-gradient-to-br tw-from-slate-600 tw-via-slate-200 tw-to-slate-600 tw-rounded-lg tw-p-6 tw-transition-all tw-ease-in-out tw-relative tw-overflow-hidden hover:laptop:-tw-translate-y-6 tw-group laptop:tw-cursor-pointer tw-border-2 tw-border-white tw-bg-white">
				<img src="<?php echo $character->image; ?>" alt="An image of <?php echo $character->name; ?>" width="" height="" class="tw-w-full tw-h-auto tw-rounded-lg" />
				<div class="laptop:tw-absolute laptop:tw-bottom-0 laptop:tw-left-0 mobile:tw-bg-white laptop:tw-bg-white/85 tw-w-full mobile:tw-p-4 laptop:tw-px-7 laptop:tw-pt-4 laptop:tw-pb-6 tw-rounded-b-lg tw-transition-all tw-ease-in-out laptop:tw-opacity-0 laptop:tw-translate-y-[175px] group-hover:laptop:tw-opacity-100 group-hover:laptop:tw-translate-y-[2px]">
					<h2 class="tw-text-xl tw-font-semibold tw-text-center tw-tracking-widest tw-mb-4 !tw-font-serif">
						<?php echo $character->name; ?>
					</h2>

					<div class="tw-flex tw-flex-col tw-flex-nowrap tw-items-start tw-justify-between tw-gap-3">
						<div class="">
							<span class="tw-block tw-font-bold !tw-font-sans !tw-text-base !tw-tracking-wide">
								Status:
							</span>
							<span class="tw-block tw-italic !tw-font-mono !tw-text-base">
								<?php echo $character->status; ?>
							</span>
						</div>
						<div class="">
							<span class="tw-block tw-font-bold !tw-font-sans !tw-text-base !tw-tracking-wide">
								Created:
							</span>
							<span class="tw-block tw-italic !tw-font-mono !tw-text-base">
								<?php echo date('F j, Y', strtotime($character->created)); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
	<?php
		endforeach;
	}
	?>

	<?php if ($pages > 1) : ?>
		<!--  -->
		<div class="tw-col-span-full tw-w-1/2 tw-mx-auto tw-flex tw-items-center tw-justify-between tw-gap-4 tw-mt-10">

			<a href="<?php echo add_query_arg('rm_pg', 1, get_the_permalink()); ?>" class="<?php echo ($page == 1) ? 'tw-pointer-events-none tw-opacity-50' : 'hover:tw-animate-pulse'; ?>">
				<div class="tw-w-fit tw-bg-white tw-rounded-sm tw-text-black tw-px-4 tw-py-3">
					First
				</div>
			</a>

			<a href="<?php echo add_query_arg('rm_pg', $page - 1, get_the_permalink()); ?>" class="<?php echo ($page <= 1) ? 'tw-pointer-events-none tw-opacity-50' : 'hover:tw-animate-pulse'; ?>">
				<div class="tw-w-fit tw-bg-white tw-rounded-sm tw-text-black tw-px-4 tw-py-3">
					Previous
				</div>
			</a>

			<a href="<?php echo add_query_arg('rm_pg', $page + 1, get_the_permalink()); ?>" class="<?php echo ($page >= $pages) ? 'tw-pointer-events-none tw-opacity-50' : 'hover:tw-animate-pulse'; ?>">
				<div class="tw-w-fit tw-bg-white tw-rounded-sm tw-text-black tw-px-4 tw-py-3">
					Next
				</div>
			</a>

			<a href="<?php echo add_query_arg('rm_pg', $pages, get_the_permalink()); ?>" class="<?php echo ($page == $pages) ? 'tw-pointer-events-none tw-opacity-50' : 'hover:tw-animate-pulse'; ?>">
				<div class="tw-w-fit tw-bg-white tw-rounded-sm tw-text-black tw-px-4 tw-py-3">
					Last
				</div>
			</a>

		</div>
	<?php endif; ?>

</div>