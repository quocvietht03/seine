<?php
/*
 * Single Therapist
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');
$job = get_field('job', get_the_ID());
$phone = get_field('phone', get_the_ID());
$email = get_field('email', get_the_ID());
$address = get_field('address', get_the_ID());
$socials = get_field('socials', get_the_ID());
$feature_section = get_field('feature_section', 'options');
?>

<main id="bt_main" class="bt-site-main">
	<div class="bt-main-detail-ss">
		<?php
		while (have_posts()) : the_post();
		?>
			<div class="bt-post">
				<div class="bt-post--main">
					<div class="bt-post--thumbnail">
						<div class="bt-cover-image">
							<?php
							if (has_post_thumbnail()) {
								the_post_thumbnail('full');
							}
							?>
						</div>
					</div>
					<div class="bt-post--infor">
						<?php if (!empty($job)) { ?>
							<div class="bt-post--job">
								<?php echo $job  ?>
							</div>
						<?php } ?>
						<h3 class="bt-post--title">
							<?php the_title(); ?>
						</h3>
						<div class="bt-post--description">
							<?php the_content(); ?>
						</div>
						<div class="bt-post--meta">
							<?php if (!empty($phone)) { ?>
								<div class="bt-post--meta-item phone">
									<a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9]+/', '', $phone)); ?>">
										<div class="bt-post--meta-item-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
												<g clip-path="url(#clip0_19_6163)">
													<path d="M27.1795 23.3041C27.1776 22.913 27.0985 22.5261 26.9466 22.1657C26.7947 21.8053 26.5731 21.4785 26.2945 21.2041L23.7445 18.6751C23.1867 18.1197 22.4316 17.808 21.6445 17.8081C21.2524 17.8123 20.8651 17.894 20.5047 18.0485C20.1443 18.203 19.818 18.4271 19.5445 18.7081L18.2335 20.0341C17.7895 20.2771 15.3985 19.1611 13.1575 16.9411C10.9165 14.7211 9.74947 12.3001 9.98047 11.8741L11.3005 10.5421C11.8605 9.97709 12.1732 9.21282 12.1698 8.41733C12.1665 7.62183 11.8473 6.86025 11.2825 6.30005L8.73547 3.77405C8.16934 3.21801 7.408 2.90572 6.61447 2.90405C6.22236 2.90801 5.8349 2.98957 5.47447 3.14404C5.11404 3.29851 4.78776 3.52283 4.51447 3.80405L1.69447 6.63305C0.527474 7.80005 0.659474 10.0591 2.06947 12.9631C3.38647 15.6631 5.66947 18.7291 8.52547 21.5521C12.6715 25.6621 17.9005 29.1001 21.2395 29.1001C21.6538 29.1212 22.068 29.0582 22.4573 28.9148C22.8466 28.7715 23.2028 28.5508 23.5045 28.2661L26.3125 25.4341C26.59 25.1535 26.8094 24.8209 26.9582 24.4554C27.1069 24.0899 27.1821 23.6987 27.1795 23.3041ZM25.4605 24.5791L22.6525 27.4111C21.1255 28.9501 15.2995 26.5741 9.37147 20.7001C6.61747 17.9701 4.40647 15.0361 3.14947 12.4381C2.01247 10.0981 1.78747 8.23805 2.54947 7.47605L5.35747 4.64405C5.69275 4.30676 6.1479 4.11585 6.62347 4.11305C6.85799 4.11268 7.09027 4.15859 7.307 4.24817C7.52374 4.33774 7.72066 4.46922 7.88647 4.63505L10.4365 7.16105C10.7708 7.49818 10.9584 7.95375 10.9584 8.42855C10.9584 8.90335 10.7708 9.35893 10.4365 9.69605L9.11647 11.0311C8.53747 11.6131 8.66047 12.6661 9.48547 14.1601C10.2449 15.4814 11.1816 16.6927 12.2695 17.7601C13.3477 18.8408 14.5691 19.7684 15.8995 20.5171C17.3995 21.3271 18.4555 21.4441 19.0345 20.8621L20.3545 19.5271C20.6898 19.1898 21.1449 18.9989 21.6205 18.9961C22.0923 18.9972 22.5447 19.1836 22.8805 19.5151L25.4305 22.0441C25.7648 22.3812 25.9524 22.8368 25.9524 23.3116C25.9524 23.7864 25.7648 24.2419 25.4305 24.5791H25.4605Z" fill="white"></path>
													<path d="M28.5002 14.9159C28.6593 14.9159 28.8119 14.8527 28.9245 14.7402C29.037 14.6277 29.1002 14.4751 29.1002 14.3159C29.0962 10.7675 27.6851 7.36546 25.1762 4.85604C22.6673 2.34663 19.2656 0.934696 15.7172 0.929932C15.5581 0.929932 15.4054 0.993146 15.2929 1.10567C15.1804 1.21819 15.1172 1.3708 15.1172 1.52993C15.1172 1.68906 15.1804 1.84167 15.2929 1.9542C15.4054 2.06672 15.5581 2.12993 15.7172 2.12993C18.9476 2.1339 22.0446 3.41915 24.3285 5.7037C26.6125 7.98824 27.897 11.0855 27.9002 14.3159C27.9002 14.4751 27.9634 14.6277 28.0759 14.7402C28.1884 14.8527 28.3411 14.9159 28.5002 14.9159Z" fill="white"></path>
													<path d="M23.5982 14.3159C23.5982 14.4751 23.6614 14.6277 23.7739 14.7402C23.8864 14.8527 24.0391 14.9159 24.1982 14.9159C24.3573 14.9159 24.5099 14.8527 24.6225 14.7402C24.735 14.6277 24.7982 14.4751 24.7982 14.3159C24.7958 11.908 23.8384 9.59924 22.136 7.89627C20.4336 6.19329 18.1252 5.23511 15.7172 5.23193C15.5581 5.23193 15.4054 5.29515 15.2929 5.40767C15.1804 5.52019 15.1172 5.6728 15.1172 5.83193C15.1172 5.99106 15.1804 6.14368 15.2929 6.2562C15.4054 6.36872 15.5581 6.43193 15.7172 6.43193C17.8069 6.43511 19.8101 7.26686 21.2874 8.74479C22.7648 10.2227 23.5958 12.2262 23.5982 14.3159Z" fill="white"></path>
													<path d="M15.1172 10.1339C15.1172 10.2931 15.1804 10.4457 15.2929 10.5582C15.4054 10.6707 15.5581 10.7339 15.7172 10.7339C16.6652 10.7395 17.5728 11.1187 18.2429 11.7894C18.913 12.46 19.2915 13.3679 19.2962 14.3159C19.2962 14.4751 19.3594 14.6277 19.4719 14.7402C19.5844 14.8527 19.7371 14.9159 19.8962 14.9159C20.0553 14.9159 20.2079 14.8527 20.3205 14.7402C20.433 14.6277 20.4962 14.4751 20.4962 14.3159C20.4915 13.0496 19.9865 11.8365 19.0914 10.9408C18.1963 10.0452 16.9835 9.53947 15.7172 9.53394C15.5581 9.53394 15.4054 9.59715 15.2929 9.70967C15.1804 9.82219 15.1172 9.97481 15.1172 10.1339Z" fill="white"></path>
												</g>
												<defs>
													<clipPath id="clip0_19_6163">
														<rect width="30" height="30" fill="white"></rect>
													</clipPath>
												</defs>
											</svg>
										</div>
										<div class="bt-post--meta-item-content">
											<?php
											echo '<span class="bt-label">' . esc_html__('Phone:', 'seine') . '</span>';
											echo '<span class="bt-value">' . $phone . '</span>';
											?>
										</div>
									</a>
								</div>
							<?php } ?>
							<?php if (!empty($email)) { ?>
								<div class="bt-post--meta-item email">
									<a href="<?php echo esc_url('mailto:' . $email); ?>">

										<div class="bt-post--meta-item-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M22.5 14.0625C18.8784 14.0625 15.9375 17.0034 15.9375 20.625C15.9375 24.2466 18.8784 27.1875 22.5 27.1875C26.1216 27.1875 29.0625 24.2466 29.0625 20.625C29.0625 17.0034 26.1216 14.0625 22.5 14.0625ZM22.5 15.9375C25.0875 15.9375 27.1875 18.0375 27.1875 20.625C27.1875 23.2125 25.0875 25.3125 22.5 25.3125C19.9125 25.3125 17.8125 23.2125 17.8125 20.625C17.8125 18.0375 19.9125 15.9375 22.5 15.9375ZM2.8125 5.87063L14.4281 14.8059C14.7656 15.0647 15.2344 15.0647 15.5719 14.8059L27.1875 5.87063V13.125C27.1875 13.6425 27.6075 14.0625 28.125 14.0625C28.6425 14.0625 29.0625 13.6425 29.0625 13.125V5.625C29.0625 4.0725 27.8025 2.8125 26.25 2.8125H3.75C2.1975 2.8125 0.9375 4.0725 0.9375 5.625V20.625C0.9375 22.1775 2.1975 23.4375 3.75 23.4375H14.0625C14.58 23.4375 15 23.0175 15 22.5C15 21.9825 14.58 21.5625 14.0625 21.5625H3.75C3.2325 21.5625 2.8125 21.1425 2.8125 20.625V5.87063ZM19.4934 21.2878L21.3684 23.1628C21.7341 23.5294 22.3284 23.5294 22.6941 23.1628L25.5066 20.3503C25.8722 19.9847 25.8722 19.3903 25.5066 19.0247C25.1409 18.6591 24.5466 18.6591 24.1809 19.0247L22.0312 21.1744L20.8191 19.9622C20.4534 19.5966 19.8591 19.5966 19.4934 19.9622C19.1278 20.3278 19.1278 20.9222 19.4934 21.2878ZM25.65 4.6875H4.35L15 12.8794L25.65 4.6875Z" fill="white"></path>
											</svg>
										</div>
										<div class="bt-post--meta-item-content">
											<?php
											echo '<span class="bt-label">' . esc_html__('Email:', 'seine') . '</span>';
											echo '<span class="bt-value">' . $email . '</span>';
											?>
										</div>
									</a>
								</div>
							<?php } ?>
							<?php if (!empty($address)) { ?>
								<div class="bt-post--meta-item address">

									<div class="bt-post--meta-item-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
											<g clip-path="url(#clip0_19_6181)">
												<mask id="mask0_19_6181" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="-1" width="30" height="31">
													<path d="M30 0H0V30H30V0Z" fill="white"></path>
													<path d="M2.34375 12.3436V12.0115C2.34375 6.68059 6.6808 2.34353 12.0117 2.34353C17.0204 2.34353 21.1514 6.17223 21.6325 11.0565L23.9817 13.1996C24.0087 12.9104 24.0234 12.6249 24.0234 12.3436V12.0115C24.0234 5.38824 18.635 -0.00021553 12.0117 -0.00021553C5.38846 -0.00021553 0 5.38824 0 12.0115V12.3436C0 15.6932 1.92047 19.5966 5.70809 23.9452C8.45391 27.0978 11.1613 29.2959 11.2753 29.3879L12.0117 29.9829V26.937C9.63686 24.8562 2.34375 18.0039 2.34375 12.3436Z" fill="white"></path>
													<path d="M22.7344 25.2539H19.2188V21.7383H22.7344V25.2539Z" fill="white"></path>
												</mask>
												<g mask="url(#mask0_19_6181)">
													<mask id="mask1_19_6181" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
														<path d="M0 1.90735e-06H30V30H0V1.90735e-06Z" fill="white"></path>
													</mask>
													<g mask="url(#mask1_19_6181)">
														<path d="M2.34375 12.3436V12.0115C2.34375 6.68059 6.6808 2.34353 12.0117 2.34353C17.0204 2.34353 21.1514 6.17223 21.6325 11.0565L23.9817 13.1996C24.0087 12.9104 24.0234 12.6249 24.0234 12.3436V12.0115C24.0234 5.38824 18.635 -0.00021553 12.0117 -0.00021553C5.38846 -0.00021553 0 5.38824 0 12.0115V12.3436C0 15.6932 1.92047 19.5966 5.70809 23.9452C8.45391 27.0978 11.1613 29.2959 11.2753 29.3879L12.0117 29.9829V26.937C9.63686 24.8562 2.34375 18.0039 2.34375 12.3436Z" fill="white"></path>
														<path d="M22.7344 25.2539H19.2188V21.7383H22.7344V25.2539Z" fill="white"></path>
														<path d="M8.20312 12.0115C8.20312 9.90808 9.90832 8.20288 12.0117 8.20288C14.1151 8.20288 15.8203 9.90808 15.8203 12.0115C15.8203 14.1149 14.1151 15.8201 12.0117 15.8201C9.90832 15.8201 8.20312 14.1149 8.20312 12.0115Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M26.6622 20.449V26.8226C26.6622 27.9302 25.7643 28.8281 24.6566 28.8281H17.236C16.1284 28.8281 15.2305 27.9302 15.2305 26.8226V20.449" stroke="white" stroke-width="2" stroke-miterlimit="10"></path>
														<path d="M28.418 22.0056L20.9473 15.1903L13.4766 22.0056" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="square"></path>
													</g>
												</g>
											</g>
											<defs>
												<clipPath id="clip0_19_6181">
													<rect width="30" height="30" fill="white"></rect>
												</clipPath>
											</defs>
										</svg>
									</div>
									<div class="bt-post--meta-item-content">
										<?php
										echo '<span class="bt-label">' . esc_html__('Address:', 'seine') . '</span>';
										echo '<span class="bt-value">' . $address . '</span>';
										?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="bt-post--appointment">
					<div class="bt-post--socials">
						<?php
						if (!empty($socials)) {
							echo '<span class="bt-title">' . esc_html__('Follow Me:', 'seine') . '</span>';
							foreach ($socials as $item) {
								if ($item['social'] == 'facebook') {
									echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
										<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.37955 0.428292V3.08008H7.80255C6.56706 3.08008 6.33603 3.67271 6.33603 4.52651V6.42494H9.27911L8.88737 9.39816H6.33603V17.022H3.26237V9.39816H0.700983V6.42494H3.26237V4.23521C3.26237 1.69392 4.81929 0.307755 7.08938 0.307755C8.1742 0.307755 9.10835 0.388113 9.37955 0.428292Z" fill="white"/></svg>
									</a>';
								}
								if ($item['social'] == 'linkedin') {
									echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
										<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.27079 4.91476V14.869H0.956061V4.91476H4.27079ZM4.48173 1.8411C4.49178 2.79534 3.76856 3.55873 2.61343 3.55873H2.59334C1.47838 3.55873 0.765213 2.79534 0.765213 1.8411C0.765213 0.866768 1.50852 0.123465 2.63352 0.123465C3.76856 0.123465 4.47169 0.866768 4.48173 1.8411ZM16.1938 9.16364V14.869H12.8891V9.54534C12.8891 8.2094 12.407 7.29534 11.2116 7.29534C10.2976 7.29534 9.75517 7.90806 9.5141 8.5007C9.43374 8.72168 9.40361 9.01297 9.40361 9.31431V14.869H6.09892C6.1391 5.84891 6.09892 4.91476 6.09892 4.91476H9.40361V6.36119H9.38352C9.81544 5.67815 10.5989 4.68373 12.3869 4.68373C14.5666 4.68373 16.1938 6.11007 16.1938 9.16364Z" fill="white"/></svg>
									</a>';
								}

								if ($item['social'] == 'twitter') {
									echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
										<svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8842 2.40597C15.4423 3.04883 14.8898 3.62137 14.257 4.08343C14.267 4.22405 14.267 4.36468 14.267 4.5053C14.267 8.79436 11.0025 13.7363 5.036 13.7363C3.19783 13.7363 1.49024 13.204 0.053857 12.2799C0.315018 12.31 0.566134 12.32 0.837339 12.32C2.35408 12.32 3.75029 11.8078 4.86524 10.9339C3.4389 10.9037 2.24359 9.96959 1.83176 8.68387C2.03265 8.71401 2.23354 8.7341 2.44448 8.7341C2.73578 8.7341 3.02707 8.69392 3.29828 8.6236C1.81167 8.32227 0.696714 7.01646 0.696714 5.43945C0.696714 5.42941 0.696714 5.40932 0.696714 5.39927C1.12863 5.64035 1.63087 5.79102 2.16323 5.8111C1.28935 5.22852 0.716803 4.2341 0.716803 3.1091C0.716803 2.50642 0.877518 1.95396 1.15877 1.47182C2.75587 3.44057 5.15654 4.72628 7.8485 4.86691C7.79828 4.62584 7.76814 4.37472 7.76814 4.1236C7.76814 2.33566 9.21457 0.879185 11.0126 0.879185C11.9467 0.879185 12.7905 1.27093 13.3831 1.90374C14.1164 1.76311 14.8195 1.49191 15.4423 1.12026C15.2012 1.8736 14.6889 2.50642 14.0159 2.9082C14.6688 2.83789 15.3016 2.65709 15.8842 2.40597Z" fill="white"/></svg>
									</a>';
								}

								if ($item['social'] == 'google') {
									echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
										<svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.2508 7.87891C14.2508 11.8538 11.5851 14.6713 7.57227 14.6713C3.7302 14.6713 0.618591 11.5597 0.618591 7.71763C0.618591 3.87556 3.7302 0.76395 7.57227 0.76395C9.45062 0.76395 11.0159 1.44699 12.2302 2.58538L10.3424 4.39732C9.83009 3.90402 8.92886 3.32533 7.57227 3.32533C5.20062 3.32533 3.26535 5.28906 3.26535 7.71763C3.26535 10.1462 5.20062 12.1099 7.57227 12.1099C10.3234 12.1099 11.3574 10.1272 11.5187 9.11217H7.57227V6.72154H14.137C14.2034 7.07254 14.2508 7.42355 14.2508 7.87891ZM22.4757 6.72154V8.71373H20.493V10.6964H18.5008V8.71373H16.5181V6.72154H18.5008V4.73884H20.493V6.72154H22.4757Z" fill="#E22E04"/></svg>
									</a>';
								}
							}
						}
						?>
					</div>
					<?php echo seine_service_button_book_now_render('Make AN Appointment'); ?>
				</div>
			</div>
		<?php

		endwhile;
		?>
	</div>
	<?php get_template_part('framework/templates/therapist', 'related-posts'); ?>
	<?php
	if (!empty($feature_section['shortcode_feature'])) {
		$id_template = $feature_section['shortcode_feature']->ID;
		echo do_shortcode('[elementor-template id="' . $id_template . '"]');
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>