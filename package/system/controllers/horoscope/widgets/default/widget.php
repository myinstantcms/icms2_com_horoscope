<?php

	class widgetHoroscopeDefault extends cmsWidget
	{

		public function run()
		{
			$data = cmsCore::getModel('horoscope')
			               ->initHoroscope();

			return [
				'data' => $data,
			];
		}
	}
