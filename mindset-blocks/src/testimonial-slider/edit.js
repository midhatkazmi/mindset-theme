/**
 * Imports.
 */
import { __ } from "@wordpress/i18n";
import {
	InspectorControls,
	useBlockProps,
	PanelColorSettings,
} from "@wordpress/block-editor";
import { PanelBody, PanelRow, ToggleControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import { SwiperInit } from "./swiper-init";

/**
 * Export.
 */
export default function Edit({ attributes, setAttributes }) {
	const { navigation, pagination, arrowColor } = attributes;

	const swiper = SwiperInit(".swiper", { navigation, pagination });

	const styles = {
		"--arrow-color": arrowColor,
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Settings", "testimonial-slider")}>
					<PanelRow>
						<ToggleControl
							label={__("Navigation", "testimonial-slider")}
							checked={navigation}
							onChange={(value) => setAttributes({ navigation: value })}
							help={__(
								"Navigation will display arrows so users can navigate forward and backward.",
								"testimonial-slider",
							)}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label={__("Pagination", "testimonial-slider")}
							checked={pagination}
							onChange={(value) => setAttributes({ pagination: value })}
							help={__(
								"Pagination will display dots so users can navigate to any slide.",
								"testimonial-slider",
							)}
						/>
					</PanelRow>
					<PanelColorSettings
						__experimentalIsRenderedInSidebar
						title={__("Color")}
						colorSettings={[
							{
								value: arrowColor,
								onChange: (value) => setAttributes({ arrowColor: value }),
								label: __("Arrow Color"),
							},
						]}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps({ style: styles })}>
				<ServerSideRender
					block="mindset-blocks/testimonial-slider"
					attributes={attributes}
				/>
			</div>
		</>
	);
}
