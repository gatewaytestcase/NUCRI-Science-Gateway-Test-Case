/**
 *  Copyright (c) 2007-2009 CyberInfrastructure and Geospatial
 *  Information Laboratory (CIGI), University of Illinois at
 *  Urbana-Champaign, All Rights Reserved.
 */

package org.simplegrid.app.testapp;

import java.util.Random;
import java.util.Calendar;

public class AppRun {
	public static void main(String[] args) throws Exception {
		if (args.length != 1) {
			System.err.println("Need arguments: jobName");
			System.exit(1);
		}
		String homePath = System.getenv("SIMPLEGRID_HOME");
		if (homePath == null || homePath.equals(""))
			homePath = "/opt/simpletest";
		System.out.println("-----------------------------------------------------");
		System.out.println("SimpleGrid java application workflow for test purpose");
		System.out.println("-----------------------------------------------------");
		System.out.println("Anytime, press Ctrol+C to stop the workflow\n");
		
		System.out.println("===============Stage 1: job submission================");
		TESTAPP testapp = new TESTAPP();
		Random rand = new Random(Calendar.getInstance().getTimeInMillis());
		String id = args[0]+"_"+rand.nextInt(100000);
		String dataset = homePath + "/tmp/sample";
		String jobId = testapp.submit(id, dataset);
		
		System.out.println();
		System.out.println("===============Stage 2: job monitoring================");
		String status = "";
		do {
			status = testapp.getStatus(jobId);
			Thread.sleep(5000);
			System.out.println("Job status ["+jobId+"]: "+status);
		} while (status!=null && !status.equals("finished") && status.indexOf("Error")<0 && status.indexOf("error")<0 );
		if (!status.equalsIgnoreCase("finished")) {
			System.out.println("Oops! There was some problem with the running job.");
			System.exit(1);
		}
		
		System.out.println();
		System.out.println("===============Stage 3: fetch results================");
		String resultFile = "/tmp/"+id+".dat";
		if (!testapp.getResult(id, jobId, resultFile).equals("success")) {
			System.out.println("Oops! There was some problem to get job result file.");
			System.exit(1);
		}
		
	}
}
