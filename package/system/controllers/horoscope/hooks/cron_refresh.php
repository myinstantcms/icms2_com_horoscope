<?php

	class onHoroscopeCronRefresh extends cmsAction
	{

		public function run()
		{
			$this->model->parseHoroscope();
		}

	}
